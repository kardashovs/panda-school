<template>

    <v-container class="px-0">
        <v-flex  style="position: relative; height: 50px">
            <v-btn  dark color="blue" class="mx-0" style=" top:0;position:absolute;left:0" :to="{name: 'sections'}"><v-icon>arrow_back</v-icon>Уроки</v-btn>
            <v-btn style="top: 0;position:absolute; right:0" @click="deleteItem" class="mx-0" color="red" dark>Удалить<v-icon>delete</v-icon></v-btn>
        </v-flex>
        <transition name="transform">
            <v-card>
                <v-card-title>

                    <h1>Редактирование урока</h1>

                </v-card-title>
                <v-card-text>
                    <v-form ref="form" lazy-validation v-model="validForm">
                        <v-layout row wrap>
                            <v-flex xs6 class="">
                                <v-text-field
                                        ref="title"
                                        label="Название языка"
                                        v-model="section.title"
                                        required
                                        :rules="[rules.required,rules.min]"
                                        validate-on-blur
                                        append-icon="title"
                                ></v-text-field>
                            </v-flex>
                            <v-flex xs6 class="pl-4">
                                <v-text-field
                                        ref="name"
                                        label="slug"
                                        v-model="slugReplace"
                                        required
                                        :rules="[rules.required,rules.min]"
                                        disabled
                                        append-icon="link"
                                ></v-text-field>
                            </v-flex>

                            <v-flex xs6>
                                <v-select
                                    ref="languages"
                                    :items="languages"
                                    item-text="title"
                                    item-value="id"
                                    v-model="section.language"
                                    label="Язык"
                                    class="input-group--focused"
                                    @change="section.level_id = false"
                                    append-icon="language"
                                    validate-on-blur
                                ></v-select>
                            </v-flex>
                            <v-flex xs6  class="pl-4">
                                <v-select
                                        ref="levels"
                                        :items="filterLevels"
                                        item-text="title"
                                        item-value="id"
                                        v-model="section.level_id"
                                        label="Уровень"
                                        class="input-group--focused"
                                        :rules="[rules.required]"
                                        validate-on-blur
                                        append-icon="chrome_reader_mode"

                                ></v-select>
                            </v-flex>
                            <v-flex xs6 class="pb-4">
                                <quill-editor
                                        ref="myQuillEditor"
                                        v-model="section.hint"
                                        :options="defaultOptions"
                                        @change="onEditorChange($event)">
                                </quill-editor>
                            </v-flex>
                            <v-flex xs6 class="pl-4">
                                <v-text-field
                                        ref="sort"
                                        label="Порядок сортировки"
                                        v-model="section.sort"
                                        required
                                        :rules="[rules.required,rules.int]"
                                        validate-on-blur
                                        append-icon="sort"
                                ></v-text-field>

                            </v-flex>
                            <v-flex xs12>
                                <v-btn color="green" dark depressed @click="submitForm">Сохранить</v-btn>
                                <v-btn color="error" :to="{name: 'sections'}">Отменить</v-btn>
                            </v-flex>


                        </v-layout>
                    </v-form>
                </v-card-text>
            </v-card>
        </transition>
    </v-container>

</template>

<script>
    import slugify from 'slugify';

    export default {
        data() {
            return {
                defaultOptions: {
                    modules: {
                        toolbar: [
                            [{ 'header': [5, 6, false] }],
                            [{ 'color': ['#B2BCC7', '#80BAFF', '#000'] }, { 'background': [] }],
                            [{ 'size': ['small', false, 'large'] }],
                            ['bold', 'italic', 'underline', 'strike'],
                            [{ 'list': 'ordered' }, { 'list': 'bullet' }],
                            [{ 'align': [] }],
                            [{ 'indent': '-1' }, { 'indent': '+1' }],
                            ['clean']
                        ]
                    },
                    history: {
                        delay: 1000,
                        maxStack: 50,
                        userOnly: false
                    },
                    readOnly: false,
                    theme: 'snow'
                },
                loadSection: false,
                section: {
                    name: '',
                    title:'',
                    level_id:'',
                    language:'',
                    hint: ''
                },
                levels:[],
                languages: [],
                validForm: true,
            }
        },
        props: [
            'rules'
        ],
        created() {
            this.getSection(this.$route.params.id);
        },
        computed: {
            editor() {
                return this.$refs.myQuillEditor.quill
            },
            slugReplace () {
                return this.section.name = slugify(this.section.title).toLowerCase().trim();
            },
            filterLevels() {

                return _.filter(this.levels, {'language_id': this.section.language})
            }
        },
        methods: {
            onEditorChange({ quill, html, text }) {
                console.log('editor change!', quill, html, text)
                this.content = html
            },
            messageStatus (message, status) { //status true === success
                this.$emit('messageStatus', message, status)
            },
            getSection(id) {
                axios.get('/api/v1/sections/'+id)
                    .then(response => {
                        if(!response.data.errors)
                        {
                            this.loadSection = true;
                            this.section = response.data.section;
                            this.levels = response.data.levels;
                            this.languages = response.data.languages;
                        } else {
                            this.$router.push({name: 'sections'})
                            this.messageStatus('Запись не найдена.', false)
                        }
                    })
                    .catch(e => {
                            this.$router.push({name: 'sections'})
                        this.$emit('messageStatus', 'Ошибка загрузки', false)
                    })
            },
            deleteItem() {
                axios.delete('/api/v1/sections/'+this.section.id)
                .then(e => {
                    this.$router.push({name: 'sections'})
                    this.messageStatus('Удалено успешно!', true)
                })
                .catch(e => {
                    this.messageStatus('Ошибка при удалении!', false)
                })
            },
            submitForm() {
                if(this.$refs.form.validate()) {
                    const formData = new FormData(this.$refs.form);
                    formData.set('_method', 'put');
                    formData.set('name', this.section.name);
                    formData.set('title', this.section.title);
                    formData.set('hint', this.section.hint);
                    formData.set('level_id', this.section.level_id);
                    formData.set('sort', this.section.sort);

                    axios.post('/api/v1/sections/'+this.section.id, formData)
                        .then(response => {
                            if(response.data.errors)
                            {
                                this.messageStatus('Запись с таким названием уже существует', false)
                            } else {
                                this.messageStatus('Сохраненно успешно', true)
                            }
                        })
                    .catch(e => {
                            this.messageStatus('Ошибка при обновлении', false)
                    })
                }
            }

        },
    }
</script>

<style >
    .ql-editor > * {
        font-family: 'ProximaNova-Regular';
        color: #B2BCC7;
        font-size: 14px;
        line-height: 15px;
    }
    .ql-editor ol, .ql-editor ul {
        padding-left: 0px
    }

    .ql-editor strong {
        font-family: 'ProximaNova-Bold';
        font-size: 16px
    }
</style>
<template>

    <v-container class="px-0">
        <v-flex  style="position: relative; height: 50px">
            <v-btn  dark color="blue" class="mx-0" style=" top:0;position:absolute;left:0" :to="{name: 'sections'}"><v-icon>arrow_back</v-icon>Уроки</v-btn>
        </v-flex>
        <transition name="transform">
            <v-card>
                <v-card-title>

                    <h1>Создание урока</h1>

                </v-card-title>
                <v-card-text>
                    <v-form ref="form" lazy-validation v-model="validForm">
                        <v-layout row wrap>
                            <v-flex xs12 class="pr-4">
                                <v-text-field
                                        ref="name"
                                        label="slug"
                                        v-model="slugReplace"
                                        required
                                        :rules="[rules.required,rules.min]"
                                        disabled
                                ></v-text-field>
                                <v-text-field
                                        ref="title"
                                        label="Название языка"
                                        v-model="section.title"
                                        required
                                        :rules="[rules.required,rules.min]"
                                        validate-on-blur
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
                                        @change="section.level_id = false"
                                        validate-on-blur
                                ></v-select>
                            </v-flex>
                            <v-flex xs6 class="pl-4">
                                <v-select
                                        ref="levels"
                                        :items="filterLevels"
                                        item-text="title"
                                        item-value="id"
                                        v-model="section.level_id"
                                        label="Уровень"
                                        :rules="[rules.required]"
                                        validate-on-blur
                                        :disabled="!section.language"
                                ></v-select>
                            </v-flex>

                            <v-flex xs-12>
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
                loadSection: false,
                section: {
                    name: '',
                    title:'',
                    level_id:null,
                    language:null
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
            this.loadList();
        },
        computed: {
            slugReplace () {
                return this.section.name = slugify(this.section.title).toLowerCase().trim();
            },
            filterLevels() {

                return _.filter(this.levels, {'language_id': this.section.language})
            }
        },
        methods: {
            loadList() {
                axios.get('/api/v1/levels/').then(e => {
                    this.levels = e.data.levels;
                })
                axios.get('/api/v1/languages/').then(e => {
                    this.languages = e.data.languages;
                })
            },
            messageStatus (message, status) { //status true === success
                this.$emit('messageStatus', message, status)
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
                    formData.set('name', this.section.name);
                    formData.set('_method', 'post');
                    formData.set('title', this.section.title);
                    formData.set('level_id', this.section.level_id);

                    axios.post('/api/v1/sections', formData)
                        .then(response => {
                            if(response.data.errors)
                            {
                                this.messageStatus('Запись с таким названием уже существует', false)
                            } else {
                                this.$router.push({name: 'section.edit', params: { id: response.data.section.id}})
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

<style scoped>

</style>
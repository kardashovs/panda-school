<template>
    <v-container class="px-0">
        <transition name="transform">
            <v-card>
                <v-card-title>
                    <h1>Создание уровня</h1>
                </v-card-title>
                <v-card-text>
                    <v-form ref="form">
                        <v-layout row wrap>
                            <v-flex xs8 class="pr-4">

                                <v-text-field
                                        ref="title"
                                        label="Название уровня"
                                        v-model="level.title"
                                        required
                                        :rules="[rules.required,rules.min]"
                                ></v-text-field>
                                <v-text-field
                                        ref="description"
                                        label="Описание уровня"
                                        v-model="level.description"
                                        required
                                        :rules="[rules.required,rules.min]"
                                ></v-text-field>
                                <v-select
                                        ref="languages"
                                        :items="languages"
                                        item-text="title"
                                        item-value="id"
                                        v-model="level.language_id"
                                        label="Язык уровня"
                                        class="input-group--focused"
                                        :rules="[rules.required,rules.int]"
                                ></v-select>
                                <v-checkbox
                                        ref="paid"
                                        label="Платный уровень?"
                                        v-model="level.paid"
                                ></v-checkbox>
                                <v-text-field
                                        ref="sort"
                                        label="Порядковый новый"
                                        v-model="level.sort"
                                ></v-text-field>
                            </v-flex>
                            <v-flex xs4>
                                <v-text-field
                                        ref="name"
                                        label="slug"
                                        v-model="slugReplace"
                                        required
                                        :rules="[rules.required,rules.min]"
                                        disabled
                                ></v-text-field>

                                <div class="input-group input-group--required">
                                    <v-layout row wrap>
                                        <v-flex xs12>
                                            <label>Изображение уровня</label>
                                        </v-flex>
                                        <v-flex xs12>
                                            <v-card class="d-inline-block">
                                                <v-container>
                                                    <div class="input-group__image">
                                                        <img :src="level.image" style="max-width: 100%; max-height: 150px" alt="">

                                                    </div>
                                                </v-container>
                                            </v-card>
                                        </v-flex>
                                        <v-flex xs12>
                                            <v-btn @click="$refs.image.click()" color="indigo" dark class="ml-0">Добавить файл <v-icon>add</v-icon></v-btn>
                                            <input type="file" @change="selectedFile" accept="image/*" ref="image" style="display: none">
                                        </v-flex>
                                    </v-layout>
                                </div>
                            </v-flex>

                            <v-flex xs-12>
                                <v-btn color="green" dark depressed @click="submitForm">Сохранить</v-btn>
                                <v-btn color="error" :to="{name: 'levels'}">Отменить</v-btn>
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
                languages: [],
                alert: {
                    message: '',
                    color: 'dark',
                    status: false,
                },
                level: {
                    id: '',
                    name: '',
                    title: '',
                    description: '',
                    paid: false,
                    image: '/design/images/no-image.jpg',
                    language_id: '',
                    sort: '',
                },
                errors: {
                    name: false,
                    title: false,
                    description: false,
                    language: false,
                    sort: false,
                    paid: false,
                }
            }
        },
        props: [
            'rules'
        ],
        created() {
            this.getLanguages();
        },
        computed: {
            slugReplace() {
                return this.level.name = slugify(this.level.title).toLowerCase().trim();
            },
        },
        methods: {
            selectedFile (event) {
                let input = event.target.files;
                if (input && input[0]) {
                    let reader = new FileReader();
                    reader.onload = (e) => {
                        this.level.image = e.target.result;
                    }
                    reader.readAsDataURL(input[0]);
                }
            },
            messageStatus(message, status) { //status true === success
                this.$emit('messageStatus', message, status)
            },
            getLanguages() {
                axios.get('/api/v1/languages').then(response => {
                    this.languages = response.data.languages;
                })
            },
            submitForm() {
                if(this.$refs.form.validate()) {
                    const formData = new FormData(this.$refs.form);
                    formData.set('name', this.level.name)
                    formData.set('title', this.level.title)
                    formData.set('description', this.level.description)
                    formData.set('paid', this.level.paid)
                    formData.set('language_id', this.level.language_id)
                    formData.set('sort', this.level.sort)
                    formData.set('image', this.$refs.image.files[0])

                    axios.post('/api/v1/levels', formData)
                        .then(response => {

                            if(response.data.errors) {
                                this.errors = response.data.errors
                                this.messageStatus('Запись с таким названием уже существует!', false)
                            } else {
                                this.messageStatus('Создано успешно!', true)
                                this.$router.push({name: 'level.edit', params: {id: response.data.level.id}})
                            }
                        })
                        .catch(response => {
                                this.messageStatus( 'Ошибка добавления. Обновите страницу и попробуйте заного', false)
                        });
                }
            }
        },
    }
</script>

<style scoped>

</style>
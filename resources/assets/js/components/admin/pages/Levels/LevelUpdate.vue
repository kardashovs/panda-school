<template>

    <v-container class="px-0">

            <v-flex v-if="loadLevel" style="position: relative; height: 50px">
                <v-btn  dark color="blue" class="mx-0" style=" top:0;position:absolute;left:0" :to="{name: 'levels'}">
                    <v-icon>arrow_back</v-icon>Уровни
                </v-btn>
                <v-btn style="top: 0;position:absolute; right:0" @click="deleteItem" class="mx-0" color="red" dark>Удалить<v-icon>delete</v-icon></v-btn>
            </v-flex>
        <transition name="transform">
            <v-card v-if="loadLevel">
                <v-card-title>
                    <h1>Редактирование уровня</h1>
                </v-card-title>
                <v-card-text>
                    <v-form ref="form" lazy-validation v-model="validForm">
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
                                        required
                                        :rules="[rules.required,rules.int]"
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
                                                        <div class="input-group__image" style="position: relative">
                                                            <v-progress-linear color="red" v-show="progressLoadImage" v-model="progressLoadImage" style="top:auto;bottom:0"></v-progress-linear>
                                                            <v-btn v-if="level.image" @click="deleteImage()" absolute small fab color="red" dark style="right: -10px;top:-10px"><v-icon>close</v-icon></v-btn>
                                                            <img v-if="level.image" :src="level.image" style="max-width: 100%; max-height: 150px" alt="">
                                                            <img v-else :src="defaultImage" style="max-width: 100%; max-height: 150px" alt="">
                                                        </div>
                                                    </v-container>
                                                </v-card>
                                            </v-flex>
                                            <v-flex xs12>
                                                <v-btn @click="$refs.image.click()" color="indigo" dark class="ml-0">Прикрепить<v-icon>attach_file</v-icon></v-btn>
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
                progressLoadImage: 0,
                languages: [
                    {title: '', id:''}
                ],
                level: {
                    id: '',
                    name: '',
                    title: '',
                    description: '',
                    paid: false,
                    image: '',
                    language_id: '',
                    sort: '',
                },
                defaultImage: '/design/images/no-image.jpg',
                validForm: true,
                loadLevel: false
            }
        },
        props: [
            'rules'
        ],
        created() {
            this.getLevel(this.$route.params.id);
            this.getLanguages();
        },
        mounted() {
        },
        computed: {
            slugReplace () {
                return this.level.name = slugify(this.level.title).toLowerCase().trim();
            },
        },
        methods: {
            async deleteItem() {
                await axios.delete('/api/v1/level/delete/'+this.level.id)
                    .then(response => {
                    const errors = response.data.errors;
                if(errors) {
                    this.messageStatus('Имеет дочерние связи', false)
                } else {
                    this.messageStatus('Успешно удалено', true)
                }
                this.$router.push({name: 'levels'});
            })
            .catch(e => {
                    this.messageStatus('Ошибка при удалении', false)
            })
            },
            deleteImage() {
                this.$refs.image.value = '';
                this.level.image = ''
            },
            selectedFile (event) {
                let input = event.target.files;
                if (input && input[0]) {
                    let reader = new FileReader();
                    reader.onload = (e) => {
                        this.level.image = e.target.result;
                    }

                    reader.onprogress = (e) => {
                        if (e.lengthComputable) {
                            this.progressLoadImage = Math.round(e.loaded/e.total*100)
                        }
                    }

                    reader.onloadend = (e) => {
                        this.progressLoadImage = 0;
                    }

                    reader.readAsDataURL(input[0]);
                }
            },
            messageStatus (message, status) { //status true === success
                this.$emit('messageStatus', message, status)
            },
            getLevel (id) {
                axios.get('/api/v1/levels/edit='+id)
                .then(response => {
                    if(!response.data.errors)
                    {
                        this.loadLevel = true;
                        this.level = response.data.level;
                    } else {
                        this.$router.push({name: 'levels'})
                        this.messageStatus('Запись не найдена.', false)
                    }
                })
                .catch(e => {
                    this.$router.push({name: 'levels'})
                    this.$emit('messageStatus', 'Ошибка загрузки', false)
                })
            },
            getLanguages() {
                axios.get('/api/v1/languages').then(response => {
                    this.languages = response.data.languages;
                })
            },
            submitForm() {
                if(this.$refs.form.validate()) {
                    const formData = new FormData(this.$refs.form);
                    formData.set('id', this.level.id)
                    formData.set('_method', 'put')
                    formData.set('name', this.level.name)
                    formData.set('title', this.level.title)
                    formData.set('description', this.level.description)
                    formData.set('paid', this.level.paid)
                    formData.set('language_id', this.level.language_id)
                    formData.set('sort', this.level.sort)
                    formData.set('image', this.$refs.image.files[0]? this.$refs.image.files[0] : this.level.image)

                    axios.post('/api/v1/levels', formData)
                        .then(response => {
                        if(response.data.errors) {
                            this.errors = response.data.errors
                            this.messageStatus('Запись с таким названием уже существует', false)
                        } else {
                            this.messageStatus('Сохраненно успешно', true)
                        }
                        })
                        .catch(e => {
                                this.messageStatus('Ошибка при обновлении', false)
                        });
                }
            }
        },
    }
</script>

<style scoped>

</style>
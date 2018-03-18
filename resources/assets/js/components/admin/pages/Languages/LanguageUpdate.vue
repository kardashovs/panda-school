<template>

    <v-container class="px-0">
            <v-flex v-if="loadLanguage" style="position: relative; height: 50px">
                <v-btn  dark color="blue" class="mx-0" style=" top:0;position:absolute;left:0" :to="{name: 'languages'}"><v-icon>arrow_back</v-icon>Языки</v-btn>
                <v-btn style="top: 0;position:absolute; right:0" @click="deleteItem" class="mx-0" color="red" dark>Удалить<v-icon>delete</v-icon></v-btn>
            </v-flex>
            <transition name="transform">
            <v-card v-if="loadLanguage">
                <v-card-title>

                    <h1>Редактирование языка</h1>

                </v-card-title>
                <v-card-text>
                    <v-form ref="form" lazy-validation v-model="validForm">
                        <v-layout row wrap>
                            <v-flex xs8 class="pr-4">
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
                                        v-model="language.title"
                                        required
                                        :rules="[rules.required,rules.min]"
                                ></v-text-field>

                                </v-flex>
                                <v-flex xs4>
                                <div class="input-group input-group--required py-0">
                                    <v-layout row wrap>
                                        <v-flex xs12>
                                            <label>Флаг языка</label>
                                        </v-flex>
                                        <v-flex xs12>
                                            <v-card class="d-inline-block">

                                                <v-container>
                                                    <div class="input-group__image" style="position: relative">
                                                        <v-progress-linear color="red" v-show="progressLoadImage" v-model="progressLoadImage" style="top:auto;bottom:0"></v-progress-linear>
                                                        <v-btn v-if="language.icon2x" @click="deleteImage()" absolute small fab color="red" dark style="right: -10px;top:-10px"><v-icon>close</v-icon></v-btn>
                                                        <img v-if="language.icon2x" :src="language.icon2x" style="max-width: 100%; max-height: 66px" alt="">
                                                        <img v-else :src="defaultImage" style="max-width: 100%; max-height: 66px" alt="">
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
                                <v-btn color="error" :to="{name: 'languages'}">Отменить</v-btn>

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
                language: {
                    id: 0,
                    name: '',
                    title: '',
                    icon2x: ''
                },
                defaultImage: '/design/images/no-image.jpg',
                validForm: true,
                loadLanguage: false
            }
        },
        props: [
            'rules'
        ],
        created() {
            this.getLanguage(this.$route.params.id);
        },
        mounted() {
        },
        computed: {
            slugReplace () {
                return this.language.name = slugify(this.language.title).toLowerCase().trim();
            },
        },
        methods: {
            async deleteItem() {
                await axios.delete('/api/v1/languages/'+this.language.id)
                .then(response => {
                    const errors = response.data.errors;
                    if(errors) {
                        this.messageStatus('Имеет дочерние связи', false)
                    } else {
                        this.messageStatus('Успешно удалено', true)
                    }
                    this.$router.push({name: 'languages'});
                })
                .catch(e => {
                        this.messageStatus('Ошибка при удалении', false)
                })
            },
            deleteImage() {
                this.$refs.image.value = '';
                this.language.icon2x = ''
            },
            selectedFile (event) {
                let input = event.target.files;
                if (input && input[0]) {
                    let reader = new FileReader();
                    reader.onload = (e) => {
                        this.language.icon2x = e.target.result;
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
            messageStatus (message, status) {
                this.$emit('messageStatus', message, status)
            },
            getLanguage (id) {
                axios.get('/api/v1/languages/'+id)
                    .then(response => {
                        if(!response.data.errors)
                        {
                            this.loadLanguage = true;
                            this.language = response.data.language;
                        } else {
                            this.$router.push({name: 'languages'})
                            this.messageStatus('Запись не найдена.', false)
                        }
                    })
                    .catch(e => {
                            this.$router.push({name: 'languages'})
                        this.$emit('messageStatus', 'Ошибка загрузки', false)
                    })
            },
            submitForm() {
                if(this.$refs.form.validate()) {
                    const formData = new FormData(this.$refs.form);
                    formData.set('_method', 'put')
                    formData.set('name', this.language.name)
                    formData.set('title', this.language.title)
                    formData.set('image', this.$refs.image.files[0]? this.$refs.image.files[0] : this.language.icon2x)

                    axios.post('/api/v1/languages/'+this.language.id, formData)
                    .then(response => {
                        if(response.data.errors) {

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
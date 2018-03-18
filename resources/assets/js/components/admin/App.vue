<template>
    <v-app id="inspire">
        <v-navigation-drawer  fixed v-model="drawer" app :clipped-left="$vuetify.breakpoint.lgAndUp">
            <v-toolbar color="blue darken-4" dark>
                <v-toolbar-title>Panda School</v-toolbar-title>
            </v-toolbar>
            <v-list dense class="">
                <v-list-tile @click="$router.push({ name: 'index'})">
                    <v-list-tile-action>
                        <v-icon color="red">dashboard</v-icon>
                    </v-list-tile-action>
                    <v-list-tile-content>
                        <v-list-tile-title>Главная</v-list-tile-title>
                    </v-list-tile-content>
                </v-list-tile>
                <v-list-group>
                    <v-list-tile slot="activator" >
                        <v-list-tile-action>
                            <v-icon color="black">school</v-icon>
                        </v-list-tile-action>
                        <v-list-tile-content>
                            <v-list-tile-title>Обучение</v-list-tile-title>
                        </v-list-tile-content>
                    </v-list-tile>
                    <v-list-tile class="pl-4" @click="$router.push({ name: 'languages'})">
                        <v-list-tile-action>
                            <v-icon color="teal darken-1">language</v-icon>
                        </v-list-tile-action>
                        <v-list-tile-content>
                            <v-list-tile-title>Языки</v-list-tile-title>
                        </v-list-tile-content>
                    </v-list-tile>
                    <v-list-tile class="pl-4" @click="$router.push({ name: 'levels'})">
                        <v-list-tile-action>
                            <v-icon color="orange">filter_list</v-icon>
                        </v-list-tile-action>
                        <v-list-tile-content>
                            <v-list-tile-title>Уровни</v-list-tile-title>
                        </v-list-tile-content>
                    </v-list-tile>
                    <v-list-tile class="pl-4" @click="$router.push({ name: 'sections'})">
                        <v-list-tile-action>
                            <v-icon color="red">chrome_reader_mode</v-icon>
                        </v-list-tile-action>
                        <v-list-tile-content>
                            <v-list-tile-title>Уроки</v-list-tile-title>
                        </v-list-tile-content>
                    </v-list-tile>
                    <v-list class="py-0">
                        <v-list-group>
                            <v-list-tile slot="activator" >
                                <v-list-tile-action>
                                    <v-icon color="black">settings</v-icon>
                                </v-list-tile-action>
                                <v-list-tile-content>
                                    <v-list-tile-title>Настройки</v-list-tile-title>
                                </v-list-tile-content>
                            </v-list-tile>
                            <v-list-tile class="pl-4" @click="$router.push({ name: 'templatesTask'})">
                                <v-list-tile-action>
                                    <v-icon color="teal darken-1">line_style</v-icon>
                                </v-list-tile-action>
                                <v-list-tile-content>
                                    <v-list-tile-title>Типы заданий</v-list-tile-title>
                                </v-list-tile-content>
                            </v-list-tile>
                        </v-list-group>
                    </v-list>

                </v-list-group>
            </v-list>
        </v-navigation-drawer>
        <v-toolbar color="blue" dark fixed app :clipped="$vuetify.breakpoint.lgAndUp">
            <v-toolbar-side-icon @click.stop="drawer = !drawer"></v-toolbar-side-icon>
            <v-toolbar-title>{{ title }}</v-toolbar-title>
        </v-toolbar>
        <v-content>
            <v-container fluid>
                <v-layout row wrap>
                    <transition name="transform" mode="out-in">
                        <router-view
                                v-on:messageStatus="messageStatus"
                                v-on:setTitle="setTitle"
                                v-bind:user="user"
                                v-bind:rules="rules"
                        ></router-view>
                    </transition>
                </v-layout>
            </v-container>
        </v-content>
        <v-footer color="indigo" app>
            <span class="white--text">&copy; 2017</span>
        </v-footer>

        <v-snackbar
                :timeout="3000"
                :top="true"
                :color="alert.color"
                :multi-line="true"
                :vertical="false"
                v-model="alert.status"
        >
            {{ alert.message }}
            <v-btn dark flat @click.native="alert.status = false">Закрыть</v-btn>
        </v-snackbar>
    </v-app>
</template>

<script>
    export default{
        data() {
            return {
                drawer: null,
                title: '',
                user: {
                    isAdmin: false,
                    isManager: false,
                    isUser: false,
                    id: null,
                    name: '',
                    email: '',
                    avatar: '',
                },
                alert: {
                    message: '',
                    color: 'dark',
                    status: false,
                },
                rules: {
                    required: (value) => !!value || 'Обязательное поле',
                    email: (value) => {
                        const pattern = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
                        return pattern.test(value) || 'Не верный формат'
                    },
                    int: (value) => {
                        const pattern = /^[1-9][0-9]*$/
                        return pattern.test(value) || 'Введите число выше 0'
                    },
                    min: (value) => {
                        return (value.length >= 5) || 'Минимум 5 символов'
                    }
                },
            }
        },
        created() {
            this.getUser();
        },
        mounted() {
            this.setTitle(this.title);
        },
        methods: {
            setTitle(title) {
                this.title = title;
            },
            messageStatus(message, status) { //status true === success
                this.alert.message = message;
                this.alert.color = status? 'success' : 'error'
                this.alert.status = true;
            },
            async getUser() {
                await axios.get('/api/v1/user/')
                    .then(e => {
                        this.user = e.data
                    })
                    .catch(e => {
                        this.$route.push('/login')
                    })

            }
        }
    }
</script>


<style>
    .transform-enter-active, .transform-leave-active {
        transition: all .5s;
        transform-origin: 0 0;

    }
    .transform-enter, .transform-leave-to {
        transform: translateY(-50%);
        opacity: 0;
        position: relative;
    }

    .fade-enter-active, .fade-leave-active {
        transition: opacity .5s;
    }
    .fade-enter, .fade-leave-to /* .fade-leave-active до версии 2.1.8 */ {
        opacity: 0;
    }
</style>
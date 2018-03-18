<template>

    <v-container>
        <v-layout row wrap d-block>
                <v-layout row style="margin-bottom: 20px">
                        <v-flex xs12>
                            <v-btn-toggle>
                            <v-btn color="green" dark class=""
                                   :to="{name: 'language.add'}"
                            >Новый язык<v-icon>add</v-icon></v-btn>
                            <v-btn color="green" dark class=""
                                   :to="{name: 'level.add'}"
                            >Новый уровень<v-icon>add</v-icon></v-btn>
                            <v-btn color="green" dark class=""
                                   :to="{name: 'section.add'}"
                            >Новый урок<v-icon>add</v-icon></v-btn>
                            </v-btn-toggle>
                        </v-flex>
                </v-layout>
                <transition name="transform"  mode="out-in">
                <v-layout row wrap v-if="loading" d-block>
                    <h2>Выбирите язык</h2>
                    <v-btn-toggle v-model="languageActive" style="margin-bottom: 20px">

                        <v-btn
                                active-class="current_language"
                                v-if="loading"
                                v-for="language in languages"
                                :key="language.id"
                                :value="language.id"
                                @click="isLanguage(language.id)"
                                color="blue"
                                dark
                        >{{ language.title }} <img :src="language.icon2x" width="20" alt="" style="margin-left: 5px"></v-btn>
                    </v-btn-toggle>

                </v-layout>
                </transition>
                <transition name="transform"  mode="out-in">
                <v-layout row wrap v-if="languageActive" d-block>
                    <h2 >Выбирите уровень</h2>
                    <v-btn-toggle v-model="levelActive" style="margin-bottom: 20px">

                        <v-btn
                                active-class="current_language"
                                v-for="level in filterLevels"
                                :key="level.id"
                                :value="level.id"
                                @click=""
                                color="blue"
                                dark
                        >{{ level.title }}</v-btn>
                    </v-btn-toggle>

                </v-layout>
                </transition>
                <transition name="transform"  mode="out-in">
                <v-layout row wrap v-if="levelActive" d-block>
                    <h2 >Уроки</h2>
                    <v-data-table
                            :headers="headers"
                            :items="filterSections"
                            class="elevation-1"
                    >
                        <template slot="items" slot-scope="props">
                            <td width="50"> {{ props.item.sort }}</td>
                            <td> {{ props.item.title }}</td>
                            <td width="100"> <strong>{{ props.item.level.title }}</strong></td>
                            <td  width="50" class="text-xs-center">
                                <span class="body-2">{{ props.item.lessons_count }}</span>

                            </td>
                            <td class="text-xs-left" width="200">
                                <v-btn dark color="orange" class="mx-0"
                                       :to="{ name: 'tasks', params: { id: props.item.id }}"
                                >
                                    Задания
                                </v-btn>
                                <v-btn :to="{ name: 'section.edit', params: { id: props.item.id }}" icon class="mx-0">
                                    <v-icon color="teal">edit</v-icon>
                                </v-btn>

                            </td>
                        </template>
                    </v-data-table>

                </v-layout>
                </transition>
        </v-layout>
    </v-container>
</template>

<script>
    export default {
        data() {
            return {
                headers: [
                    {text: '#', value:'sort', width: '20px'},
                    {text: 'Название урока', value:'title', sortable: false},
                    {text: 'Уровень', value:'level_id', sortable: false},
                    {text: 'Заданий', value:'lessonsCount', sortable: false, align: 'center'},
                    {sortable: false},
                ],
                title: 'Уроки',
                languages: [],
                levels: [],
                sections:[],
                loading: false,
                languageActive: '',
                levelActive: '',
            }
        },
        created() {
            this.loadLanguages();
            this.loadLevels();
            this.loadSections();
            this.$emit('setTitle', this.title)
        },
        mounted() {
            this.loading = true;
        },
        computed: {
            filterLevels() {
                return _.filter(this.levels, {'language_id': this.languageActive})
            },
            filterSections() {
                return _.filter(this.sections, {'level_id': this.levelActive})
            }
        },
        methods: {
            isLanguage(id) {
                this.levelActive = false;
                return (id === this.languageActive)? true : false
            },
            messageStatus(message, status) {
                this.$emit('messageStatus', message, status)
            },
            loadLevels() {
                axios.get('/api/v1/levels/')
                    .then(response => { this.levels = response.data.levels })
                    .catch(e => { this.messageStatus('Ошибка загрузки данных', false) });
            },
            loadSections() {
                axios.get('/api/v1/sections')
                    .then(response => { this.sections = response.data.sections })
                    .catch(e => { this.messageStatus('Ошибка загрузки данных', false) });
            },
            loadLanguages() {
                axios.get('/api/v1/languages')
                .then(response => {

                    this.languages = response.data.languages;
                }).catch( e => {
                        this.messageStatus('Ошибка загрузки языков', false)
                })
            },
            filterByList(id, levels) {
                this.levels = _.filter(levels, {'language_id': id})
            },
        },
    }
</script>

<style scoped>
    .current_language {
        background-color: #1565C0!important;
        border-color: #1565C0!important;
    }
    .btn-toggle .btn {
        color: #fff;
        opacity: 1;
    }
</style>
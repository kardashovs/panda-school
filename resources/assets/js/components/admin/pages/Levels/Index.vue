<template>
    <v-container class=" px-0">
        <transition name="transform">
        <v-card v-if="loading">
            <v-card-text>
                    <v-layout row wrap >
                    <v-container style="position:relative;" class="px-0">
                        <h1>Выбирите язык</h1>
                        <v-btn absolute right :to="{name: 'language.add'}"  dark color="green"
                               style="top: calc(50% - 18px);">
                            <v-icon dark>add</v-icon>
                        </v-btn>
                    </v-container>
                    <v-flex xs3  v-for="language in languages" :key="language.name"  class="mb-2" @click="filterByList(language.id)">
                        <v-container class="text-xs-center">
                        <v-card hover color="blue darken-2" class="white--text py-4">

                                <img class="mx-auto" :src="language.icon" :srcset="language.icon2x+' 2x'" alt="avatar">
                                <div class="headline"">{{language.title}} </div>


                        </v-card>
                        </v-container>
                    </v-flex>
                </v-layout>

                    <v-layout row wrap>
                    <v-container class="px-0">
                        <v-card-title class="px-0">
                            <h1>Уровни</h1>
                            <v-btn  color="green" dark @click="$router.push({name: 'level.add'})" >Новый<v-icon>add</v-icon></v-btn>
                        </v-card-title>

                        <transition name="transform">
                        <v-data-table
                                :headers="headers"
                                :items="filterLevels"
                                hide-actions
                                class="">

                            <template slot="items" slot-scope="props">
                                <td class="pl-0 text-xs-center">
                                    <strong>{{ props.item.sort }}</strong>
                                </td>
                                <td class="px-0 py-0">
                                    <img :src="props.item.image" alt="" style="vertical-align: top;max-width: 150px; max-height: 50px" >
                                </td>
                                <td  style="max-width: 150px; text-overflow: ellipses;white-space: nowrap; overflow:hidden">{{ props.item.title }}</td>
                                <td style="max-width: 250px; text-overflow: ellipses;white-space: nowrap; overflow:hidden">{{ props.item.description }}</td>
                                <td><v-avatar size="24px">
                                    <img :src="props.item.language.icon" :srcset="props.item.language.icon2x+' 2x'" alt="">
                                </v-avatar></td>
                                <td class="text-xs-center">
                                    <v-icon color="green accent-4" v-if="props.item.paid">attach_money</v-icon>
                                    <v-icon color="red" v-else>money_off</v-icon>
                                </td>

                                <td class="text-xs-right" width="130">
                                    <v-btn :to="{ name: 'level.edit', params: { id: props.item.id }}" icon class="mx-0">
                                        <v-icon color="teal">edit</v-icon>
                                    </v-btn>
                                    <v-btn icon class="mx-0" @click="deleteItem(props.item)">
                                        <v-icon color="red accent-4">delete</v-icon>
                                    </v-btn>
                                </td>
                            </template>
                            <template slot="no-data" class="px-0">
                                <v-alert :value="true" color="info" icon="warning" >
                                    Выбирите язык или создайте новый уровень языка!
                                </v-alert>
                            </template>
                        </v-data-table>
                        </transition>
                    </v-container>
                </v-layout>

            </v-card-text>
        </v-card>
        </transition>

    </v-container>


</template>

<script>

    export default {
        data() {
            return {
                levels: [],
                title: 'Уроки',
                languages: [],
                languageActive: '',
                filterLevels:[],
                loading: false,
                headers: [
                    {text: '#', value:'sort', width: '20px', class: 'pl-0'},
                    {sortable: false, class: 'px-0 py-0'},
                    {text: 'Название', value:'title', sortable: false},
                    {text: 'Описание', value:'description', sortable: false},
                    {text: 'Язык', value:'language.title', sortable: false},
                    {text: 'Платный', value:'paid', align: 'center'},
                    { text: '', value: 'name', sortable: false }
                ],

            }
        },
        created() {
            this.loadLanguages();
            this.$emit('setTitle', this.title)
        },
        mounted() {

        },
        computed: {
            orderByList() {
                return _.orderBy(this.levels, 'sort')
            },
            isLevels() {
                if (this.filterLevels.length)
                    return true;
                else
                    return false;
            }

        },
        methods: {
            messageStatus(message, status) { //status true === success
                this.$emit('messageStatus', message, status)
            },
            loadLanguages() {
                axios.get('/api/v1/languages').then(response => {
                    this.loading = true;
                    this.languages = response.data.languages;
                }).catch( e => {
                    this.messageStatus('Ошибка загрузки языков', false)
                })
            },
            async loadLevels() {
                await axios.get('/api/v1/levels/')
                .then(response => { this.levels = response.data.levels })
                .catch(e => { this.messageStatus('Ошибка загрузки данных', false) });
            },
            async deleteItem(item) {
                await axios.delete('/api/v1/level/delete/'+item.id)
                .then(response => {
                    const errors = response.data.errors;
                    if(errors) {
                        this.messageStatus('Имеет дочерние связи', false)
                    } else {
                        this.messageStatus('Успешно удалено', true)
                    }
                    this.filterByList(item.language_id)
                })
                .catch(e => {
                    this.messageStatus('Ошибка при удалении', false)
                })
            },
            async filterByList(id) {
                await this.loadLevels();
                this.languageActive = id;
                this.filterLevels = _.filter(this.levels, {'language_id': id})

            }
        },
    }
</script>
<style>
</style>

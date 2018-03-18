<template>
    <v-container class="px-0">
        <transition name="transform">
            <v-layout row wrap v-if="loading">
                <v-flex xs12>
                    <v-container>
                        <v-btn color="green" dark class="mx-0"
                               :to="{name: 'language.add'}"
                        >Создать<v-icon>add</v-icon></v-btn>
                    </v-container>
                </v-flex>
                <v-flex xs3 v-for="language in languages" :key="language.id">
                    <v-container>
                        <v-card dark color="blue darken-2" :to="{ name: 'language.edit', params: { id: language.id }}">
                            <v-card-title class="pb-0">
                                <img :src="language.icon" :srcset="language.icon2x+' 2x'"
                                     alt="" class="mx-auto" style="width: 33px;height:33px">
                            </v-card-title>
                            <v-card-text class="text-xs-center">
                                <h3 class="headline mb-0">{{ language.title }}</h3>
                            </v-card-text>
                        </v-card>
                    </v-container>
                </v-flex>

            </v-layout>

        </transition>
    </v-container>
</template>

<script>
    export default {
        data() {
            return {
                title: 'Языки',
                languages: [],
                loading: false,
            }
        },
        created() {
            this.$emit('setTitle', this.title)
            this.loadLanguages();
        },
        methods: {
            loadLanguages() {
                axios.get('/api/v1/languages').then(response => {
                    this.loading = true;
                    this.languages = response.data.languages;
                }).catch( e => {
                    this.$emit('messageStatus', 'Ошибка загрузки языков', false)
                })
            },
        },
    }
</script>

<style scoped>

</style>
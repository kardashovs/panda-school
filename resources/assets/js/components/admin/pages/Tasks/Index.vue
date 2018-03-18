<template>
    <transition name="transform">
    <v-layout v-if="loading">
        <v-flex xs3 v-for="task in tasks" :key="task.id">
            <v-container class="px-2 py-0" style="height: 100%">
                <v-card height="100%">
                    <v-card-media
                        src="/design/images/section-1.png"
                        height="100"
                    >

                    </v-card-media>
                    <v-card-text>
                        <v-layout class=" align-center">
                            <v-flex xs6>
                                <v-chip class="mx-0">{{ task.section.level.title }}</v-chip>
                            </v-flex>
                            <v-flex xs6 class="text-xs-right">
                                <v-avatar size="32px">
                                    <img :src="task.section.level.language.icon2x" :srcset="task.section.level.language.icon2x+' 2x'" alt="trevor">
                                </v-avatar>
                            </v-flex>
                        </v-layout>
                        <div class="py-4" style="height: 90px; overflow:hidden">
                            {{ task.title }}
                        </div>
                    </v-card-text>
                    <v-divider></v-divider>
                    <v-card-actions>
                        <v-btn :to="{name: 'task.edit', params: {id: task.id}}" class="mr-0" style="margin-left: auto;" dark flat color="teal">Изменить</v-btn>
                    </v-card-actions>
                </v-card>
            </v-container>
        </v-flex>
    </v-layout>
    </transition>
</template>

<script>
    export default {
        data() {
            return {
                title: 'Задания',
                tasks: [],
                loading: false,
            }
        },
        created() {
            this.$emit('setTitle', this.title)
            this.loadTasks();
        },
        methods: {
            messageStatus(message, status) {
                this.$emit('messageStatus', message, status)

            },
            loadTasks() {
                axios.get('/api/v1/tasks', {params: {id: this.$route.params.id} })
                    .then(e => {
                        this.loading = true;
                        this.tasks = e.data.tasks
                    })
                    .catch(e => {
                        this.messageStatus('Ошибка загрузки данных', false)
                    })
            }
        },

    }
</script>

<style scoped>

</style>
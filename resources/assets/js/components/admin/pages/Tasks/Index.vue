<template>
    <transition name="transform">
    <v-layout v-if="loading">
        <v-flex xs3 v-for="task in tasks" :key="task.id">
            <v-container class="px-2 py-0">
                <v-card>
                    <v-card-media
                        src="/design/images/section-1.png"
                        height="100"
                    >
                    </v-card-media>
                    <v-card-text>{{ task.title }}</v-card-text>
                    <v-card-actions>
                        <v-btn><v-icon>add</v-icon></v-btn>
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
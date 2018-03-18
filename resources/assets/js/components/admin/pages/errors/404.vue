<template>
    <v-container>
        <v-flex xs12 class="text-xs-center mt-5">
            <img src="/design/images/404.png" style="width: 438px;" alt="">
            <div class="display-1" style="color: #80BAFF;">Упс! Страница не найдена...</div>
        </v-flex>
    </v-container>
</template>

<script>
    export default {
        data() {
            return {
                title: 'Страница не найдена'
            }
        },
        created() {
            this.$emit('setTitle', this.title)
        },
    }
</script>

<style scoped>

</style>
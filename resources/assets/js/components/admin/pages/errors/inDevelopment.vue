<template>
    <v-container>
        <v-flex xs12 class="text-xs-center mt-5">
            <img src="/design/images/dev-page.png" style="max-width: 70%;" alt="">
            <div class="display-1" style="color: #80BAFF;">Упс! Скоро будет готово... Мы уже заканчиваем!</div>
        </v-flex>
    </v-container>
</template>

<script>
    export default {
        data() {
            return {
                title: 'В разработке'
            }
        },
        created() {
            this.$emit('setTitle', this.title)
        },
    }
</script>

<style scoped>

</style>
<template>
    <v-container>
        Ошибка

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
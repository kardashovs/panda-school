<template>
<v-container>
    <v-layout>


        <v-flex xs12>
        <v-card>
            <v-card-title>
                <h2>Список типов заданий</h2>
            </v-card-title>
            <v-card-text>
                <v-data-table
                    :headers="headers"
                    :items="templates"
                    class="elevation-1"
                >
                    <template slot="items" slot-scope="props">
                        <td>{{ props.item.name }}</td>
                        <td>{{ props.item.title }}</td>
                        <td>{{ props.item.lessons_count }}</td>
                        <td>{{ props.item.path }}</td>
                        <td>
                            <v-btn :to="{ name: 'section.edit', params: { id: props.item.id }}" icon class="mx-0">
                                <v-icon color="teal">edit</v-icon>
                            </v-btn>
                            <v-btn icon class="mx-0" @click="deleteItem(props.item)">
                                <v-icon color="red accent-4">delete</v-icon>
                            </v-btn>
                        </td>
                        <!--<textarea name="" id="" cols="30" rows="10">-->
                            <!--{{JSON.stringify(props.item.fields, null, 4) }}-->
                        <!--</textarea>-->
                    </template>
                </v-data-table>
            </v-card-text>
        </v-card>
    </v-flex>
    </v-layout>
</v-container>
</template>

<script>
    export default {
        data() {
            return {
                title: 'Типы заданий',
                headers: [
                    {text: 'URI', value:'name', sortable: false},
                    {text: 'Название урока', value:'title', sortable: false},
                    {text: 'Всего заданий', value:'lessons_count', sortable: false},
                    {text: 'Путь файла', value:'path', sortable: false},
                    {sortable: false},

                ],
                templates: [],
                loading: false,
            }
        },
        created() {
            this.getTemplates();
            this.$emit('setTitle', this.title)
        },
        methods: {
            getTemplates() {
                axios.get('/api/v1/templates/').then(e => {
                    this.templates = e.data.templates
                })
            },
            jsonParse(str) {
                console.log()
            }
        },
    }
</script>

<style scoped>

</style>
<template>
    <div>
        <label :for="id">{{label}}</label>
        <input type="text" v-bind:key="" :name="name" :id="id" :placeholder="placeholder">
    </div>
</template>

<script>

    import slugify from 'slugify';

    export default {
        data() {
            return {
                slugValue: ''
            }
        },
        props: [
            'slug',
            'id',
            'classes',
            'placeholder',
            'name',
            'label'
        ],
        mounted() {
        },
        computed: {
            slugText: function () {
                return slugify(this.slug);
            }
        },
        methods: {
        }
    }
</script>

<styles>

</styles>
<template>
    <div class="card m-t-2">
        <div class="card-content">
            <p>A demo SPA on <strong>Vue.js</strong> running <strong>GraphQL</strong> as backend implemented on <strong>Laravel</strong></p>

            <p class="has-text-grey-light m-t-1">
                <small>&copy; {{ appName }} 2017, by <a href="http://www.qcode.in" target="_blank">QCode.in</a></small>
            </p>
        </div>
    </div>
</template>

<script>
    export default {
        name: 'SideFooter',
        computed: {
            appName() {
                return this.$store.getters.appName;
            }
        }
    }
</script>
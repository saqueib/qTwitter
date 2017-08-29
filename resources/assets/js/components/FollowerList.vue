<template>
    <div class="card-list">
        <div class="columns" v-for="users in chunkedUsers">
            <div class="column is-4" v-for="user in users" :key="user.id">
                <profile-card class="card-equal-height" :user="user"></profile-card>
            </div>

            <p v-if="!users.length && !loading" class="has-text-centered has-text-grey-light">
                no users found...
            </p>
        </div>
    </div>

</template>

<script>
    import ProfileCard from "./ProfileCard";

    export default {
        components: {ProfileCard},
        name: 'FollowerList',
        props: {users: {type: Array, default: []}},
        data() {
            return {
            }
        },
        computed: {
            loading() {
                return this.$store.getters.isLoading;
            },
            chunkedUsers() {
                return _.chunk(this.users, 3);
            }
        },
        created() {
            console.log('FollowerList Component created.')
        }
    }
</script>
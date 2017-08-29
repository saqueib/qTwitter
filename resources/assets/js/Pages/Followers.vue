<template>
    <div class="bg-light is-fullheight">
        <section class="hero is-medium is-primary profile-cover is-bold" :style="{'background': 'url(' + profileData.cover + ')'}">
            <div class="hero-body">
                <div class="container">
                </div>
            </div>
        </section>

        <section class="sub-nav">
            <div class="container">
                <div class="columns">
                    <div class="column is-3">
                        <img class="is-circle profile-pic image" width="90%" :src="profileData.avatar" alt="">
                    </div>

                    <div class="column is-6">
                        <profile-nav :user="profileData"></profile-nav>
                    </div>

                    <div class="column is-3 has-text-right">
                        <a v-if="profileData.id === $parent.me.id" href="" class="button">Edit Profile</a>
                        <follow-button :following.sync="profileData.is_following" v-if="profileData.id != $parent.me.id" :user="profileData"></follow-button>
                    </div>

                </div>
            </div>
        </section>

        <div class="container m-t-2">
            <div class="columns">
                <div class="column is-3">
                    <profile-info :user="profileData"></profile-info>
                </div>
                <!--end sidebar-->

                <div class="column is-9">
                    <follower-list :users="followers"></follower-list>
                    <button v-if="followers.length < profileData.followers_count" :class="{'is-loading': loading}" class="button m-t-1 m-b-4 is-fullwidth">
                        Load more...
                    </button>
                </div>
                <!--end main content area-->
            </div>
        </div>
    </div>
</template>

<script>
    import FollowButton from "../components/FollowButton";
    import FollowerList from "../components/FollowerList";
    import ProfileNav from "../components/ProfileNav";
    import ProfileInfo from "../components/ProfileInfo";

    export default {
        components: {
            ProfileInfo,
            ProfileNav,
            FollowerList,
            FollowButton},
        name: 'Followers',
        props: ['username'],
        data() {
            return {
                loading: false,
                profileData: {
                    cover: '/img/cover-placeholder.jpg',
                    avatar: '/img/avatar-placeholder.svg',
                    profile:  {},
                    followers: []
                }
            }
        },
        computed: {
            followers() {
                return this.profileData.followers
            }
        },
        created() {
            this.fetchTweets();
            console.log('Profile Component created.')
        },
        methods: {
            fetchTweets() {
                let vm = this;
                this.$store.dispatch('getFollowUserByUsername', {username: this.username}).then(function (res) {
                    vm.profileData = res.data.user
                })
            }
        },
        watch: {
            '$route' (to) {
                this.fetchTweets();
            }
        }
    }
</script>
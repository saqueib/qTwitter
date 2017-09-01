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

                <div class="column is-6">
                    <div class="card">
                        <tweet-list :tweets="profileData.tweets"></tweet-list>
                    </div>
                    <button v-if="profileData.tweets.length < profileData.tweets_count" :class="{'is-loading': loading}" class="button m-t-1 m-b-4 is-fullwidth">
                        Load more...
                    </button>
                </div>
                <!--end main content area-->

                <div class="column is-3">
                    <div class="is-sticky" style="top: 4.5rem;">
                        <follow-suggestions></follow-suggestions>
                        <side-footer></side-footer>
                    </div>
                </div>
                <!--end right sidebar-->
            </div>
        </div>
    </div>
</template>

<script>
    import FollowButton from "../components/FollowButton";
    import ProfileNav from "../components/ProfileNav";
    import ProfileInfo from "../components/ProfileInfo";

    export default {
        components: {
            ProfileInfo,
            ProfileNav,
            FollowButton
        },
        name: 'Profile',
        props: ['username'],
        data() {
            return {
                loading: false
            }
        },
        computed: {
          profileData() {
              return this.$store.getters.profilePage
          }
        },
        created() {
            this.fetchTweets();
            console.log('Profile Component created.')
        },
        methods: {
            fetchTweets() {
                this.$store.dispatch('getTweetsByUsername', this.username)
            }
        },
        watch: {
            '$route' () {
                this.fetchTweets();
            }
        }
    }
</script>
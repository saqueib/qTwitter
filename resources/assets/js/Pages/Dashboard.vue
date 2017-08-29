<template>
    <div class="bg-light is-fullheight p-t-2">
        <div class="container">
            <div class="columns">
                <div class="column is-3">
                    <div class="is-sticky" style="top: 5rem;">
                        <profile-card :user="me"></profile-card>
                    </div>
                    <!-- end profile card -->
                </div>
                <!--end sidebar-->

                <div class="column is-6">
                    <div class="card">
                        <tweet-box :user="me"></tweet-box>
                        <tweet-list :tweets="tweets"></tweet-list>
                    </div>
                    <button :disabled="noMoreTweets" @click.prevent="loadMore" :class="{'is-loading': loading}" class="button m-t-1 m-b-1 is-fullwidth">
                        {{ noMoreTweets ? 'No more tweets...' : 'Load more...' }}
                    </button>
                </div>
                <!--end main content area-->

                <div class="column is-3">
                    <div class="is-sticky" style="top: 5rem;">
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
    import TweetBox from "../components/TweetBox";

    export default {
        components: {TweetBox},
        data() {
            return {
                loading: false,
                nextOffset: 26,
                perPage: 26,
                noMoreTweets: false
            }
        },
        computed: {
            me() {
              return this.$store.getters.me
            },
            tweets() {
                return this.$store.getters.feed
            }
        },
        created() {
            this.fetchFeed();
            console.log('Get user feed')
        },
        methods: {
            fetchFeed() {
                this.noMoreTweets = false;
                this.$store.dispatch('getDashboardFeed')
            },
            loadMore() {
                let vm = this;
                vm.loading = true;
                this.$store.dispatch('getDashboardFeed', {offset: this.nextOffset}).then(function (res) {
                    vm.loading = false;

                   if( res.data.tweets.length === vm.perPage ) {
                       vm.nextOffset = vm.nextOffset+vm.perPage;
                   } else {
                       vm.noMoreTweets = true;
                   }
                });
            }
        },
        watch: {
            '$route' (to) {
                this.fetchFeed();
            }
        }
    }
</script>
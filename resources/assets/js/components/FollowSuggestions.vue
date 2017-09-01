<template>
    <div class="card follow-suggestions">

        <header class="card-header">
            <p class="card-header-title">
                Who to follow
                    &nbsp; -
                    <a :disabled="loading"
                       style="font-weight: normal"
                       class="button is-small is-link"
                       @click.prevent="refresh"> refresh</a>
            </p>
        </header>

        <div class="card-content is-transparent" :class="{'is-loading': loading}">
            <article class="media" v-for="user in suggestions" :key="user.id">
                <figure class="media-left">
                    <router-link :to="{ name: 'profile', params: { username: user.username }}">
                        <p class="image is-64x64 is-circle">
                            <img alt="" :src="user.avatar">
                        </p>
                    </router-link>
                </figure>
                <div class="media-content">
                    <div class="content">
                        <p class="m-b-0">
                            <router-link :to="{ name: 'profile', params: { username: user.username }}">
                                <strong class="has-text-dark">{{ user.name }}</strong>
                            </router-link>
                            <small>@{{ user.username }}</small>
                        </p>
                        <follow-button :user="user" @followUser="handleFollowed" class="is-small"></follow-button>
                    </div>
                </div>
            </article>

            <div v-if="!suggestions.length && !loading" class="has-text-centered">
                <span class="has-text-grey">Currently no suggestions to follow user</span>
            </div>
        </div>
    </div>
</template>

<script>
    import FollowButton from "./FollowButton";
    export default {
        components: {FollowButton},
        name: 'FollowSuggestions',
        props: {
            limit: {
                default: 3, type: Number
            }
        },
        data() {
            return {
                loading: true
            }
        },
        computed: {
          suggestions() {
              return this.$store.getters.followerSuggestions;
          }
        },
        created() {
          this.fetchSuggestions();
        },
        methods: {
            fetchSuggestions() {
                this.loading = true
                this.$store.dispatch('getFollowUserSuggestions', this.limit).then((res) => {
                    this.loading = false;
                });
            },
            handleFollowed(user) {
                this.$store.commit('REMOVE_FROM_FOLLOW_SUGGESTION', user);
            },
            refresh() {
                this.fetchSuggestions()
            }
        },
        watch: {
            'suggestions' (to) {
                if(to.length === 0) {
                    this.refresh();
                }
            }
        }
    }
</script>
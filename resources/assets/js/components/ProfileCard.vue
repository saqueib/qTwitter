<template>
    <div class="card profile-card">
        <div class="card-image">
            <figure class="image">
                <img :src="user.cover" class="image" alt="">
            </figure>
        </div>
        <div class="card-content">
            <div class="media">
                <div class="media-left">
                    <figure class="image is-64x64 is-circle">
                        <router-link :to="{ name: 'profile', params: { username: user.username }}">
                            <img :src="user.avatar" alt="">
                        </router-link>
                    </figure>
                </div>
                <div class="media-content">
                    <p class="title is-5">
                        {{ user.name }}
                    </p>
                    <p class="subtitle is-6">
                        <router-link :to="{ name: 'profile', params: { username: user.username }}">
                            @{{ user.username }}
                        </router-link>
                    </p>
                </div>
            </div>

            <nav class="level">
                <div class="level-item has-text-centered">
                    <div>
                        <router-link :to="{ name: 'profile', params: { username: user.username }}">
                            <p class="is-6 has-text-grey-light">
                                <small>Tweets</small>
                            </p>
                            <p class="is-4">{{ user.tweets_count || 0 }}</p>
                        </router-link>
                    </div>
                </div>

                <div class="level-item has-text-centered">
                    <div>
                        <router-link :to="{ name: 'following', params: { username: user.username }}">
                            <p class="is-6 has-text-grey-light">
                                <small>Following</small>
                            </p>
                            <p class="is-4">{{ user.following_count || 0 }}</p>
                        </router-link>
                    </div>
                </div>

                <div class="level-item has-text-centered">
                    <div>
                        <router-link :to="{ name: 'followers', params: { username: user.username }}">
                            <p class="is-6 has-text-grey-light">
                                <small>Followers</small>
                            </p>
                            <p class="is-4">{{ user.followers_count || 0 }}</p>
                        </router-link>
                    </div>
                </div>
            </nav>
        </div>
    </div>
</template>

<script>
    export default {
        name: 'ProfileCard',
        props: ['user'],
        created() {
          console.log('ProfileCard Component created.')
        }
    }
</script>
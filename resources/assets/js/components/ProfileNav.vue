<template>
    <div class="tabs is-borderless">
        <ul>
            <router-link exact tag="li" :to="{ name: 'profile', params: { username: user.username }}">
                <a>
                    <strong>Tweets</strong>
                    <span class="tag is-rounded m-l-1">{{ user.tweets_count }}</span>
                </a>
            </router-link>

            <router-link exact tag="li" :to="{ name: 'followers', params: { username: user.username }}">
                <a>
                    <strong>Followers</strong>
                    <span class="tag is-rounded m-l-1">{{ user.followers_count }}</span>
                </a>
            </router-link>

            <router-link exact tag="li" :to="{ name: 'following', params: { username: user.username }}">
                <a>
                    <strong>Following</strong>
                    <span class="tag is-rounded m-l-1">{{ user.following_count }}</span>
                </a>
            </router-link>
        </ul>
    </div>
</template>

<script>
    export default {
        name: 'ProfileNav',
        props: ['user'],
        created() {
          console.log('ProfileNav Component created.')
        }
    }
</script>
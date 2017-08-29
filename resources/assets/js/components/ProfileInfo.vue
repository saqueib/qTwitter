<template>
    <div class="profile-info m-t-1 is-sticky" style="top: 4.5rem;">
        <p class="title is-4">{{ user.name }}</p>
        <p class="subtitle is-6 has-text-grey-light">@{{ user.username }}</p>

        <div class="bio">
            <p v-html="user.profile.bio"></p>

            <div class="profile-meta m-t-1">
                <p>
                                    <span class="icon is-small">
                                        <i class="fa fa-map-marker"></i>
                                    </span>
                    <small class="has-text-grey-light">{{ user.profile.city }} {{ user.profile.country }}</small>
                </p>
                <p>
                                    <span class="icon is-small">
                                        <i class="fa fa-calendar"></i>
                                    </span>
                    <small class="has-text-grey-light">Joined {{ user.created_at }}</small>
                </p>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: 'ProfileInfo',
        props: ['user'],
    }
</script>
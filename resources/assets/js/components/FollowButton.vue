<template>
    <a  href="" @click.prevent="toggleFollow" class="button" :class="btnClasses">
        <span class="icon is-small">
          <i class="fa fa-flash"></i>
        </span>
        <span>
            {{ isFollowing ? 'Unfollow' : 'Follow' }}
        </span>
    </a>
</template>

<script>
    export default {
        name: 'followButton',
        props: {
            user: Object,
            following: {type: Boolean, default: false}
        },
        data() {
            return {
                loading: false,
                isFollowing: this.following
            }
        },
        computed: {
            btnClasses() {
              return {
                  'is-danger': this.isFollowing,
                  'is-primary' : !this.isFollowing,
                  'is-loading': this.loading
              }
            }
        },
        methods: {
            toggleFollow() {
                this.loading = true;

                let action = this.user.is_following ? 'unFollowUser' : 'followUser';
                this.$store.dispatch(action, this.user.id).then((res) => {
                    this.loading = false;
                    this.isFollowing = !this.isFollowing;
                    this.$emit(action, this.user);
                })
            }
        },
        watch: {
            'following' (to) {
                this.isFollowing = to;
            }
        }
    }
</script>
import { http, str } from '../utils'

// Get authenticated user
export const loginUser = ({ commit }) => {
    // show loading
    commit('TOGGLE_LOADING');

    return http.get( '/me').then(res => {
        // hide loader
        commit('TOGGLE_LOADING');

        commit('ADD_ME', res.data );
        return res.data;
    }).catch((err) => {
        console.log(err)
    })
}

// Get dashboard feed
export const getDashboardFeed = ({commit}, pager={}) => {

    let from = pager.offset ?  ',offset:' + pager.offset : '';
    let to = pager.limit ? 'first:' + pager.limit :  'first:26';

    let query = `{
        tweets(${to}${from}){
            id,
            body,
            created_at,
            replies_count,
            likes_count,
            user{
                username,
                name,
                avatar
            }
        }
    }`;

    // show loading
    commit('TOGGLE_LOADING');
    let cacheBuster = new Date().getMilliseconds();

    return http.get('/graphql?query=' + str.stripLines(query) + '&t=' + cacheBuster).then(function (res) {
        // hide loader
        commit('TOGGLE_LOADING');

        if( pager.offset ) {
            commit('APPEND_TWEETS_IN_FEED', res.data.data.tweets)
        } else {
            commit('ADD_TWEETS_IN_FEED', res.data.data.tweets)
        }

        return res.data
    })
}

// Get follow user suggestions
export const getFollowUserSuggestions = ({commit}, limit) => {
    let limitQuery = `(first:${limit})`;

    let query = `{
        followSuggestions${limitQuery}
        {
            id,
            name,
            username,
            avatar
        }
    }`;

    return http.get( '/graphql?query=' + str.stripLines(query) ).then(function (res) {
        commit('ADD_FOLLOW_SUGGESTIONS', res.data.data.followSuggestions)
    });
}

// Get tweets for a user by username
export const getTweetsByUsername = ({commit}, username) => {
    let query = `{
        user(username:"${username}") {
            id,
            username,
            name,
            avatar,
            cover,
            created_at,
            followers_count,
            following_count,
            is_following,
            likes_count,
            tweets_count,
            profile {
                bio,
                city,
                country
            },
            tweets(first:16){
                id,
                body,
                created_at,
                replies_count,
                likes_count,
                user{
                    id,
                    username,
                    name,
                    avatar
                }
            }
        }
    }`;

    // show loading
    commit('TOGGLE_LOADING');

    return http.get( '/graphql?query=' + str.stripLines(query) ).then(function (res) {
        // hide loader
        commit('TOGGLE_LOADING');

        commit('PROFILE_PAGE', res.data.data.user)
        return res.data
    })
}

// Get tweet details with replies
export const getTweetDetails = ({commit}, options) => {
    let from = options.offset ?  ',offset:' + options.offset : '';
    let to = options.limit ? 'first:' + options.limit :  'first:26';

    let query = `{
        tweets(id:${options.id}){
            id,
            body,
            created_at,
            updated_at,
            replies_count,
            likes_count,
            user{
                id,
                username,
                name,
                avatar,
                is_following
            },
            replies(${to}${from}){
                body,
                created_at,
                user{
                    username,
                    name,
                    avatar,
                }
            }
        }
    }`;

    let cacheBuster = new Date().getMilliseconds();

    return http.get('/graphql?query=' + str.stripLines(query) + '&t=' + cacheBuster).then(function (res) {
        commit('ADD_TWEET_DETAIL', res.data.data.tweets[0]);
        return res.data
    })

}

// Get followers for a user by username
export const getFollowUserByUsername = ({commit}, options = {}) => {
    let userType = options.type ? options.type : 'followers';

    let from = options.offset ?  ',offset:' + options.offset : '';
    let to = options.limit ? 'first:' + options.limit :  'first:26';

    let query = `{
        user(username:"${options.username}") {
            id,
            username,
            name,
            avatar,
            cover,
            created_at,
            followers_count,
            following_count,
            is_following,
            likes_count,
            tweets_count,
            profile {
                bio,
                city,
                country
            },
            ${userType}(${to}${from}){
                id,
                username,
                name,
                avatar,
                cover,
                created_at,
                followers_count,
                following_count,
                is_following,
                tweets_count,
            }
        }
    }`;

    // show loading
    commit('TOGGLE_LOADING');

    return http.get( '/graphql?query=' + str.stripLines(query) ).then(function (res) {
        // hide loader
        commit('TOGGLE_LOADING');
        return res.data
    })
}

// Follow a user
export const followUser = ({commit}, userId) => {
    let mutation = `mutation {
        followUser(user_id: ${userId})
        {
            id,
            name,
            avatar
        }
    }`;

    return http.get( '/graphql?query=' + str.stripLines(mutation) ).then((res) => {
        commit('INCREMENT_FOLLOW_USER_COUNT');
    });
}

// Unfollow a user
export const unFollowUser = ({commit}, userId) => {
    let mutation = `mutation {
        unFollowUser(user_id: ${userId})
        {
            id,
            name,
            avatar
        }
    }`;

    return http.get( '/graphql?query=' + str.stripLines(mutation) ).then((res) => {
        commit('DECREMENT_FOLLOW_USER_COUNT');
    });
}

// Post Tweet
export const postTweet = ({ commit }, body) => {
    let mutation = `mutation {
        createTweet(body:"${body}")
        {
            id,
            body,
            created_at,
            replies_count,
            likes_count,
            user{
                id,
                username,
                name,
                avatar
            }
        }
    }`;

    return http.get( '/graphql?query=' + mutation ).then((res) => {
        if(res.data.data.createTweet) {
            commit('PREPEND_TWEET_IN_FEED', res.data.data.createTweet);
        }

        return res.data;
    });
}

// Post Reply
export const postReply = ({ commit }, data) => {
    let mutation = `mutation {
        createReply(body:"${data.body}", tweet_id: ${data.id})
        {
            id,
            body,
            created_at,
            replies_count,
            likes_count,
            user{
                id,
                username,
                name,
                avatar
            }
        }
    }`;

    return http.get( '/graphql?query=' + mutation ).then((res) => {
        if(res.data.data.createReply) {
            commit('PREPEND_REPLY_IN_TWEET', res.data.data.createReply);
        }

        return res.data;
    });
}
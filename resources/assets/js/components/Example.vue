<template>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Example Component</div>

                    <div class="panel-body">
                        I'm an example component!
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        created() {
            console.log('Component mounted.');

            axios.get('/graphql?query=query+getUserNameAndId{users(first:5){id,name}}')
                .then(function (res) {
                    console.log(res);
                }).catch(function (err) {
                    console.error(err);
                })
        }
    }
</script>

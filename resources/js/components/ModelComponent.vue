<template>

</template>

<script>
    export default {
        data: function(){
            return {

            }
        },
        methods: {

            log (message)
            {
                console.log(message);
            },

            continueAction () {
                // console.log('ici')
                this.$router.push('choose-ancient')
            }
        }
    }

</script>

<style>

</style>

<template>
    <div class="card card-default">
    </div>
</template>

<script>
    export default {
        props: ['prop_user', 'prop_user_options'],
        data () {
            return {
            }
        },
        computed: {
          errors: {
            get: function () {
              return this.errors
            },
            set: function () {
                // set
            }
          }
        },
        created() {
        },
        methods: {
            
        }
    }
</script>
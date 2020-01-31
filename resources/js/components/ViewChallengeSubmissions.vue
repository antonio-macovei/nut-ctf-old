<template>
    <div class="tab-content-box">
        <button class="btn btn-warning" @click="getSubmissions(challenge.id)">Get submissions</button>
    </div>
</template>

<script>
    export default {
        props: {
            challenge: {
                type: Object,
                required: true
            }
        },
        data() {
            return {
                
            };
        },
        methods: {
            getSubmissions(id) {
                axios.get('/admin/submissions/get/' + id)
                .then(response => {
                    console.log(response);
                })
                .catch(error => {
                    console.log(error);
                });
            }
        }
    };
</script>
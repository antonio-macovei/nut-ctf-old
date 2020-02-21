<template>
    <div class="tab-content-box">
        <table class="table table-hover table-striped">
            <thead class="thead-dark">
                <tr>
                <th>#</th>
                <th>Team</th>
                <th>User</th>
                <th>Flag</th>
                <th>Status</th>
                <th>Time</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(submission, index) in submissions" v-bind:key="submission.id">
                    <th scope="row">{{ index }}</th>
                    <td>{{ submission.team.name }}</td>
                    <td>{{ submission.user.name }}</td>
                    <td>{{ submission.flag }}</td>
                    <td>{{ submission.status }}</td>
                    <td>{{ submission.submitted_at }}</td>
                </tr>
            </tbody>
        </table>

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
                submissions: null
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
        },
        mounted () {
            axios.get('/admin/submissions/get/' + this.challenge.id)
            .then(response => {
                console.log(response);
                this.submissions = response.data;
            })
            .catch(error => {
                console.log(error);
            });
        }
    };
</script>
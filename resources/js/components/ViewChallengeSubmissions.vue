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
                    <td style="text-align:center;">
                        <img v-if="submission.status" src="/images/icons/correct.svg" class="status-icon" />
                        <img v-else src="/images/icons/incorrect.svg" class="status-icon" />
                    </td>
                    <td>{{ submission.submitted_at | formatDate }}</td>
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
        mounted () {
            axios.get('/admin/submissions/get/' + this.challenge.id)
            .then(response => {
                this.submissions = response.data;
            })
            .catch(error => {

            });
        }
    };
</script>
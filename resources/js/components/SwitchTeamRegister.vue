<template>
    <div>
        <div class="form-group row">
            <label class="col-md-4 col-form-label text-md-right">Join existing team</label>

            <div class="col-md-6">
                <div class="btn-group btn-group-toggle" data-toggle="buttons">
                    <label class="btn btn-outline-primary active" @click="useToken = false;">
                        <input type="radio" name="team-switch" id="team-switch-no" autocomplete="off" checked=""> No
                    </label>
                    <label class="btn btn-outline-primary" @click="useToken = true;">
                        <input type="radio" name="team-switch" id="team-switch-yes"  autocomplete="off"> Yes
                    </label>
                </div>
            </div>
        </div>

        <div class="form-group row">
            <label for="team" class="col-md-4 col-form-label text-md-right">
               <span v-if="useToken"> Team Token</span>
               <span v-else>Team Name</span>
            </label>

            <div class="col-md-6">
                <input id="team" type="team" class="form-control" v-bind:class="{ 'is-invalid': error }" name="team" autocomplete="team">
                <span v-if="error" class="invalid-feedback" role="alert">
                    <strong>{{ errorMessage }}</strong>
                </span>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
       props: {
           error: {
               type: Boolean,
               default: false
           },
           errorMessage: {
               type: String,
               default: ""
           }
       },
        data() {
            return {
                useToken: false
            };
        },
    };
</script>
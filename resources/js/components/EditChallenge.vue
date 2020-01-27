<template>
    <div class="tab-content-box">
        <form @submit.prevent="submitChallenge()">
            <div class="form-group">
                <label v-bind:for="'name-' + challenge.id">Name</label>

                <input v-bind:id="'name-' + challenge.id" type="text" v-bind:class="{ 'is-invalid': errors.name }" class="form-control" name="name" v-model="challenge.name">
                <span v-if="errors.name" class="invalid-feedback" role="alert">
                    <strong v-for="error in errors.name" v-bind:key="error">{{ error }}</strong>
                </span>
            </div>
            <div class="form-group">
                <label v-bind:for="'desc-' + challenge.id">Description</label>
                <textarea v-model="challenge.description" name="description" v-bind:class="{ 'is-invalid': errors.description }" class="form-control" v-bind:id="'desc-' + challenge.id"></textarea>
                <span v-if="errors.description" class="invalid-feedback" role="alert">
                    <strong v-for="error in errors.description" v-bind:key="error">{{ error }}</strong>
                </span>
            </div>

            <div class="form-group">
                <label v-bind:for="'flag-' + challenge.id">Flag</label>

                <input v-bind:id="'flag-' + challenge.id" type="text" v-bind:class="{ 'is-invalid': errors.flag }" class="form-control" name="flag" v-model="challenge.flag">
                <span v-if="errors.flag" class="invalid-feedback" role="alert">
                    <strong v-for="error in errors.flag" v-bind:key="error">{{ error }}</strong>
                </span>
            </div>

            <div class="row">
                <div class="form-group col-md-6">
                    <label v-bind:for="'points-' + challenge.id">Points</label>

                    <input v-bind:id="'points-' + challenge.id" type="text" v-bind:class="{ 'is-invalid': errors.points }" class="form-control" name="points" v-model="challenge.points">
                    <span v-if="errors.points" class="invalid-feedback" role="alert">
                        <strong v-for="error in errors.points" v-bind:key="error">{{ error }}</strong>
                    </span>
                    <span class="valid-feedback" role="alert">
                        <strong>Data has been saved successfully!</strong>
                    </span>
                </div>

                <div class="form-group col-md-6">
                    <label v-bind:for="'category-' + challenge.id">Category</label>
                    <select v-bind:id="'category-' + challenge.id" v-bind:class="{ 'is-invalid': errors.category }" class="form-control" name="category" v-model="challenge.category">
                        <option value="1">Web</option>
                        <option value="5">OSINT</option>
                    </select>
                    <span v-if="errors.category" class="invalid-feedback" role="alert">
                        <strong v-for="error in errors.category" v-bind:key="error">{{ error }}</strong>
                    </span>
                </div>
            </div>

            <div class="row">
                <div class="form-group col-md-6">
                    <label v-bind:for="'availability-' + challenge.id">Availability</label>

                    <input v-bind:id="'availability-' + challenge.id" type="text" v-bind:class="{ 'is-invalid': errors.availability }" class="form-control" name="availability" v-model="challenge.availability">
                    <span v-if="errors.availability" class="invalid-feedback" role="alert">
                        <strong v-for="error in errors.availability" v-bind:key="error">{{ error }}</strong>
                    </span>
                </div>
            </div>

            <div v-if="success" class="form-group"><span class="text-success">Data has been saved successfully!</span></div>

            <button type="submit" class="btn btn-outline-warning float-right"><span class="fas fa-download mr-2"></span>Save</button>
        </form>
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
                errors: {},
                success: false,
            };
        },
        methods: {
            submitChallenge() {
                this.errors = {};
                axios.post('/admin/challenges/update', {
                    id: this.challenge.id,
                    name: this.challenge.name,
                    description: this.challenge.description,
                    points: this.challenge.points,
                    category: this.challenge.category,
                    availability: this.challenge.availability,
                })
                .then(response => {
                    this.success = true;
                    this.$emit('updatedChallenge');
                })
                .catch(error => {
                    if (error.response.status === 422) {
                        this.errors = error.response.data.errors || {};
                    }
                });
            }
        }
    };
</script>
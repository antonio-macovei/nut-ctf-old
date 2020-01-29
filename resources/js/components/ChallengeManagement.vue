<template>
<div class="row">
    <div class="col-4">
        <div class="list-group" id="list-tab" role="tablist">
            <a v-for="(challenge, index) in challenges" v-bind:key="challenge.id" :class="{ 'active': index === 0 }" class="list-group-item list-group-item-action list-group-item-warning with-icon" :id="'ch-' + challenge.id + '-list'" data-toggle="list" :href="'#ch-' + challenge.id" role="tab" :aria-controls="challenge.id">
                <div class="list-item-icon-container"><img :src="getIcon(challenge.id)" class="list-item-icon" /></div> {{ challenge.name }}
            </a>
        </div>
    </div>
    <div class="col-8">
        <div class="tab-content" id="nav-tabContent">
            <div v-for="(challenge, index) in challenges" v-bind:key="challenge.id" :class="{ 'show active': index === 0 }" class="tab-pane fade" :id="'ch-' + challenge.id" role="tabpanel" :aria-labelledby="'ch-' + challenge.id + '-list'">

                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" :id="'overview-tab-ch-' + challenge.id" data-toggle="tab" :href="'#overview-ch-' + challenge.id" role="tab" aria-controls="home" aria-selected="true">Overview</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" :id="'edit-tab-ch-' + challenge.id" data-toggle="tab" :href="'#edit-ch-' + challenge.id" role="tab" aria-controls="contact" aria-selected="false">Edit</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" :id="'submissions-tab-ch-' + challenge.id" data-toggle="tab" :href="'#submissions-ch-' + challenge.id" role="tab" aria-controls="profile" aria-selected="false">Submissions</a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane fade show active" :id="'overview-ch-' + challenge.id" role="tabpanel" :aria-labelledby="'overview-tab-ch-' + challenge.id">
                        <div class="tab-content-box">
                            <h3>{{ challenge.name }} ({{ challenge.points }} points)</h3>
                            <p>{{ challenge.description }}</p>
                        </div>
                    </div>
                    <div class="tab-pane fade" :id="'edit-ch-' + challenge.id" role="tabpanel" :aria-labelledby="'edit-tab-ch-' + challenge.id">
                        <edit-challenge @updatedChallenge="refresh" :challenge="challenge" :categories="categories"></edit-challenge>
                    </div>
                    <div class="tab-pane fade" :id="'submissions-ch-' + challenge.id" role="tabpanel" :aria-labelledby="'submissions-tab-ch-' + challenge.id">
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</template>

<script>
    export default {
        props: {
            challenges: {
                type: Array,
                required: true
            },
            categories: {
                type: Array,
                required: true
            }
        },
        data() {
            return {

            };
        },
        methods: {
            refresh () {
                this.$forceUpdate();
            },
            getChallengeIndex: function(challenge_id) {
                let index = -1;
                $.each(this.challenges, function(i, challenge) {
                    if (challenge.id === challenge_id) {
                        index = i;
                    }
                });
                return index;
            },
            getCategoryIndex: function(category_id) {
                let index = -1;
                $.each(this.categories, function(i, category) {
                    if (category.id === category_id) {
                        index = i;
                    }
                });
                return index;
            },
            getIcon: function (challenge_id) {
                let challenge_index = this.getChallengeIndex(challenge_id);
                let category_index = this.getCategoryIndex(this.challenges[challenge_index].category_id);
                return '/images/icons/' + this.categories[category_index].short_name + '.svg';
            }
        }
    };
</script>
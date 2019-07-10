<template>
    <div class="container">
        <div class="col-md-12">

            <!-- Box Comment -->
            <div class="card card-widget">
                <div class="card-header">
                    <div class="user-block">
                        <span class="username">
                            <a href="#" v-if="project.user">{{ project.user.name }}</a>
                            <span v-else>ناشناس</span>
                        </span>
                        <span class="description">۵ ساعت پیش به اشتراک گذاشته شد</span>
                    </div>
                    <!-- /.user-block -->
                    <div class="card-tools">
                        <router-link to="/projects" class="btn btn-tool">
                            <i class="fa fa-arrow-left"></i>
                        </router-link>
                    </div>
                    <!-- /.card-tools -->
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <!-- post text -->
                    <div class="mb-5" v-html="project.body"></div>
                    <!-- Attachment -->
                    <div class="attachment-block clearfix" v-if="project.accepted_proposal">

                        <div class="attachment-pushed">
                            <p>پیشنهاد قبول شده</p>
                            <img class="img-circle img-sm" :src="'/images/profiles/' + project.proposal.users[0].photo" :alt="project.proposal.users[0].name">
                            <h4 class="attachment-heading pr-5"><a href="#">{{ project.proposal.users[0].name }}</a></h4>

                            <div class="attachment-text pt-2">
                                مهلت اتمام پروژه: <strong>{{ project.proposal.deadline }}</strong>
                            </div>
                            <!-- /.attachment-text -->
                        </div>
                        <!-- /.attachment-pushed -->
                    </div>
                    <!-- /.attachment-block -->

                    <!-- Social sharing buttons -->
                    <a class="btn btn-info btn-sm mr-1"
                       v-for="category in project.categories"
                       :href="'/projects/' + category.slug"
                    >
                        <i class="fa fa-hashtag"></i>{{ category.name }}
                    </a>
                    <span class="float-left text-muted"><b><strong>{{ project.proposals_count }}</strong></b> پیشنهاد داده شده</span>
                </div>
                <!-- /.card-body -->
                <!-- /.card-footer -->
                <div class="card-footer">
                    <form @submit.prevent="store" v-if="$gate.isFreelancer()">
                        <!-- .img-push is used to add margin to elements next to floating images -->
                        <div class="row">
                            <div class="input-group col-md-6">
                                <input class="form-control" placeholder="مبلغ مورد نظر شما" type="number" name="offer" id="offer"
                                       v-model="form.offer"  :class="{ 'is-invalid': form.errors.has('offer') }">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">تومان</span>
                                </div>
                                <has-error :form="form" field="offer"></has-error>
                            </div>
                            <div class="input-group col-md-6">
                                <input class="form-control" placeholder="مدت زمان لازم برای اتمام پروژه" type="number" name="deadline" id="deadline"
                                       v-model="form.deadline" :class="{ 'is-invalid': form.errors.has('deadline') }">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">روز</span>
                                </div>
                                <has-error :form="form" field="deadline"></has-error>
                            </div>
                            <div class="img-push col-md-12 pt-2 mt-2">
                                <label for="description">توضیحات</label>
                                <textarea class="form-control" name="description" id="description" cols="50" rows="5"
                                          v-model="form.description" :class="{ 'is-invalid': form.errors.has('description') }">
                                </textarea>
                                <has-error :form="form" field="description"></has-error>
                            </div>

                            <button type="submit" class="btn btn-info mt-2">ورود</button>
                        </div>
                    </form>
                    <div v-if="$gate.isAdmin() || ($gate.isUser() && user.id === project.user_id)"
                         v-for="proposal in project.proposals">
                        <div class="card-comment">
                            <!-- User image -->
                            <img class="img-circle img-sm" :src="'/images/profiles/' + user.photo" :alt="user.name">

                            <div class="comment-text">
                                <span class="username">
                                    <strong>{{ proposal.users[0].name }}</strong>
                                    <span class="mr-2">مهلت زمان برای اتمام:‌ {{ proposal.deadline }}</span>
                                    <span class="mr-3">مبلغ پیشنهادی:‌ {{ proposal.offer }}</span>
                                    <span class="text-muted float-left">
                                        <button class="btn btn-success btn-sm"
                                                @click="acceptProposal(proposal.id)"
                                                v-if="! project.proposal_id && project.is_open && proposal.id !== project.accepted_proposal">
                                            <i class="fa fa-check"></i> قبول پیشنهاد
                                        </button>
                                        <button class="btn btn-danger btn-sm"
                                                @click="destroyAcceptProposal"
                                                v-if="proposal.id === project.accepted_proposal">
                                            <i class="fa fa-remove"></i> رد پیشنهاد
                                        </button>
                                        {{ proposal.created_at }}
                                    </span>
                                </span><!-- /.username -->
                                <br>
                                {{ proposal.description }}
                            </div>
                            <!-- /.comment-text -->
                        </div>
                    </div>
                </div>
                <!-- /.card-footer -->
            </div>
            <!-- /.card -->

        </div>
    </div>
</template>

<script>
    export default {
        name: "Project",

        data() {
            return {
                user: window.user,
                project: {},
                form: new form({
                    offer: '',
                    deadline: '',
                    description: ''
                })
            }
        },

        mounted() {
            axios.get('/api' + this.$route.fullPath)
                .then(({ data }) => {
                    this.project = data;
                });
        },

        methods: {
            store() {
                this.form.post('/api/proposal/' + this.$route.params.slug)
                        .then(() => {
                            swal.fire(
                                'ارسال شد!',
                                'پیشنهاد شما باری این پروژه ثبت شد.',
                                'success'
                            );
                            this.$router.push('/projects');
                        })
                        .catch(() => {
                            swal.fire(
                                'مشکلی پیش امد!',
                                'لطفا دوباره امتحان کنید.',
                                'warning'
                            );
                        })
            },

            acceptProposal(id) {
                axios.post('/api/accept-proposal', {
                    project: this.project.id,
                    proposal: id
                })
                .then(() => {
                    // swal.fire(
                    //     'ارسال شد!',
                    //     'پیشنهاد مورد نظر ثبت شد.',
                    //     'success'
                    // );
                    // this.$router.push('/projects');
                })
                .catch(() => {
                    swal.fire(
                        'مشکلی پیش امد!',
                        'لطفا دوباره امتحان کنید.',
                        'warning'
                    );
                })
            },
            destroyAcceptProposal() {
                axios.delete('/api/accept-proposal/' + this.project.slug)
                .then(() => {
                    swal.fire(
                        'ارسال شد!',
                        'پیشنهاد مورد نظر حذف شد.',
                        'success'
                    );
                    this.$router.push('/projects');
                })
                .catch(() => {
                    swal.fire(
                        'مشکلی پیش امد!',
                        'لطفا دوباره امتحان کنید.',
                        'warning'
                    );
                })
            }
        }
    }
</script>

<style scoped>

</style>
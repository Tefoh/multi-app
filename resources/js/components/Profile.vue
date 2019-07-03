<template>
    <div class="container">
        <div class="row">
            <div class="col-md-12 mt-5">
                <div class="card card-widget widget-user">
                    <!-- Add the bg color to the header using any of the bg-* classes -->
                    <div class="widget-user-header bg-info-active">
                        <h3 class="widget-user-username">{{ this.form.name }}</h3>
                        <h5 class="widget-user-desc">موسس و مدیر</h5>
                    </div>
                    <div class="widget-user-image">
                        <img class="img-circle elevation-2" :src="'/images/profiles/' + user.photo" alt="User Avatar">
                    </div>
                    <div class="card-footer">
                        <div class="row">
                            <div class="col-sm-4 border-left">
                                <div class="description-block">
                                    <h5 class="description-header">۳,۲۰۰</h5>
                                    <span class="description-text">فروش</span>
                                </div>
                                <!-- /.description-block -->
                            </div>
                            <!-- /.col -->
                            <div class="col-sm-4 border-left">
                                <div class="description-block">
                                    <h5 class="description-header">۱۳,۰۰۰</h5>
                                    <span class="description-text">دنبال کننده</span>
                                </div>
                                <!-- /.description-block -->
                            </div>
                            <!-- /.col -->
                            <div class="col-sm-4">
                                <div class="description-block">
                                    <h5 class="description-header">۳۵</h5>
                                    <span class="description-text">محصولات</span>
                                </div>
                                <!-- /.description-block -->
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header p-2">
                        <ul class="nav nav-pills">
                            <li class="nav-item"><a class="nav-link" href="#activity" data-toggle="tab">فعالیت‌ها</a></li>
                            <li class="nav-item"><a class="nav-link active show" href="#settings" data-toggle="tab">تنظیمات</a></li>
                        </ul>
                    </div><!-- /.card-header -->
                    <div class="card-body">
                        <div class="tab-content">
                            <div class="tab-pane" id="activity">
                                <!-- Post -->
                                <div class="post">
                                    <div class="user-block">
                                        <img class="img-circle img-bordered-sm" src="/dist/img/user1-128x128.jpg" alt="user image">
                                        <span class="username">
                          <a href="#">حسام موسوی</a>
                          <a href="#" class="float-left btn-tool"><i class="fa fa-times"></i></a>
                        </span>
                                        <span class="description">ارسال شده در ۲۵ آذر ۱۳۹۷</span>
                                    </div>
                                    <!-- /.user-block -->
                                    <p>

                                        لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است. چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است و برای شرایط فعلی تکنولوژی مورد نیاز و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد.
                                    </p>

                                    <p>
                                        <a href="#" class="link-black text-sm mr-2"><i class="fa fa-share mr-1"></i> اشتراک گذاری</a>
                                        <a href="#" class="link-black text-sm"><i class="fa fa-thumbs-o-up mr-1"></i> لایک</a>
                                        <span class="float-left">
                                          <a href="#" class="link-black text-sm">
                                            <i class="fa fa-comments-o mr-1"></i> نظر (۵)
                                          </a>
                                        </span>
                                    </p>

                                    <input class="form-control form-control-sm" type="text" placeholder="نظر خود را وارد کنید">
                                </div>
                                <!-- /.post -->

                                <!-- Post -->
                                <div class="post clearfix">
                                    <div class="user-block">
                                        <img class="img-circle img-bordered-sm" src="/dist/img/user7-128x128.jpg" alt="User Image">
                                        <span class="username">
                                          <a href="#">نینا الکس</a>
                                          <a href="#" class="float-left btn-tool"><i class="fa fa-times"></i></a>
                                        </span>
                                        <span class="description">ارسال شده - ۳ روز پیش</span>
                                    </div>
                                    <!-- /.user-block -->
                                    <p>
                                        لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است. چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است و برای شرایط فعلی تکنولوژی مورد نیاز و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد.
                                    </p>

                                    <form class="form-horizontal">
                                        <div class="input-group input-group-sm mb-0">
                                            <input class="form-control form-control-sm" placeholder="نظر خود را تایپ کنید">
                                            <div class="input-group-append">
                                                <button type="submit" class="btn btn-danger">ارسال</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <!-- /.post -->

                                <!-- Post -->
                                <div class="post">
                                    <div class="user-block">
                                        <img class="img-circle img-bordered-sm" src="/dist/img/user6-128x128.jpg" alt="User Image">
                                        <span class="username">
                                          <a href="#">محمد محمدی</a>
                                          <a href="#" class="float-left btn-tool"><i class="fa fa-times"></i></a>
                                        </span>
                                        <span class="description">ارسال شده - ۵ روز پیش</span>
                                    </div>
                                    <!-- /.user-block -->
                                    <div class="row mb-3">
                                        <div class="col-sm-6">
                                            <img class="img-fluid" src="/dist/img/photo1.png" alt="Photo">
                                        </div>
                                        <!-- /.col -->
                                        <div class="col-sm-6">
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <img class="img-fluid mb-3" src="/dist/img/photo2.png" alt="Photo">
                                                    <img class="img-fluid" src="/dist/img/photo3.jpg" alt="Photo">
                                                </div>
                                                <!-- /.col -->
                                                <div class="col-sm-6">
                                                    <img class="img-fluid mb-3" src="/dist/img/photo4.jpg" alt="Photo">
                                                    <img class="img-fluid" src="/dist/img/photo1.png" alt="Photo">
                                                </div>
                                                <!-- /.col -->
                                            </div>
                                            <!-- /.row -->
                                        </div>
                                        <!-- /.col -->
                                    </div>
                                    <!-- /.row -->

                                    <p>
                                        <a href="#" class="link-black text-sm mr-2"><i class="fa fa-share mr-1"></i> اشتراک گذاری</a>
                                        <a href="#" class="link-black text-sm"><i class="fa fa-thumbs-o-up mr-1"></i> لایک</a>
                                        <span class="float-left">
                                        <a href="#" class="link-black text-sm">
                                            <i class="fa fa-comments-o mr-1"></i> نظر (۵)
                                        </a>
                                    </span>
                                    </p>

                                    <input class="form-control form-control-sm" type="text" placeholder="نظر خود را تایپ کنید">
                                </div>
                                <!-- /.post -->
                            </div>
                            <!-- /.tab-pane -->

                            <div class="tab-pane active show" id="settings">
                                <form class="form-horizontal" @submit.prevent="update">
                                    <div class="form-group">
                                        <label for="name" class="col-sm-2 control-label">نام</label>

                                        <div class="col-sm-10">
                                            <input v-model="form.name" type="text" class="form-control" id="name" placeholder="نام"
                                                   :class="{ 'is-invalid': form.errors.has('name') }">
                                            <has-error :form="form" field="name"></has-error>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="email" class="col-sm-2 control-label">ایمیل</label>

                                        <div class="col-sm-10">
                                            <input v-model="form.email" type="email" class="form-control" id="email" placeholder="ایمیل"
                                                   :class="{ 'is-invalid': form.errors.has('email') }">
                                            <has-error :form="form" field="email"></has-error>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="file" class="col-sm-2 control-label">عکس پروفایل</label>

                                        <div class="col-sm-10">
                                            <input type="file" id="file" name="photo" accept="image/*"
                                                   @change="editPhoto"
                                                   :class="{ 'is-invalid': form.errors.has('photo') }">
                                            <has-error :form="form" field="photo"></has-error>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="password" class="col-sm-4 control-label">رمز عبور(برای تغییر نکردن رمز اینجا را خالی بگذارید)</label>

                                        <div class="col-sm-10">
                                            <input type="password" class="form-control" id="password" placeholder="رمز عبور"
                                                   v-model="form.password"
                                                   :class="{ 'is-invalid': form.errors.has('password') }">
                                            <has-error :form="form" field="password"></has-error>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-offset-2 col-sm-10">
                                            <button type="submit" class="btn btn-info">
                                                اپدیت پروفایل
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <!-- /.tab-pane -->
                        </div>
                        <!-- /.tab-content -->
                    </div><!-- /.card-body -->
                </div>
                <!-- /.nav-tabs-custom -->
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "Profile",

        data() {
            return {
                user: {},
                form: new form({
                    name : '',
                    email : '',
                    password : '',
                    type : '',
                    photo : '',
                })
            }
        },

        mounted() {
            this.loadUser();
        },

        methods: {
            loadUser() {
                axios.get('api/profile')
                    .then(({ data }) => {
                        this.form.fill(data);
                        this.user = data;
                    })
            },

            editPhoto(photo) {
                let file = photo.target.files[0];
                let reader = new FileReader();

                if (file['size'] < 2111775) {
                    reader.onloadend = () => {
                        this.form.photo = reader.result;
                    };
                    reader.readAsDataURL(file);
                } else {
                    swal.fire({
                        type: 'error',
                        title: 'مشکل...',
                        text: 'حجم فایل نباید بیشتر از 2mg باشد'
                    })
                }
            },

            update() {
                this.$Progress.start();
                this.form.patch('api/profile')
                    .then(() => {
                        this.$Progress.finish();
                        this.loadUser();
                    }).catch(() => {
                        this.$Progress.fail();
                });
            }
        }
    }
</script>

<style scoped>

</style>
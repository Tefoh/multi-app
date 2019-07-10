<template>
    <div class="container">
        <div class="col-md-12 pt-5">
            <!-- general form elements -->
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">پروژه جدید</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form role="form" @submit.prevent="storeProject">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="title">موضوع</label>
                            <input class="form-control" id="title" placeholder="موضوع پروژه را وارد کنید" type="text" name="title"
                                   v-model="form.title" :class="{ 'is-invalid': form.errors.has('title') }">
                            <has-error :form="form" field="title"></has-error>
                        </div>
                        <div class="form-group">
                            <label for="budget">بودجه</label>
                            <input class="form-control" id="budget" placeholder="بودجه اختصاصی را وارد کنید" type="number" name="buget"
                            v-model="form.budget" :class="{ 'is-invalid': form.errors.has('budget') }">
                            <has-error :form="form" field="budget"></has-error>
                        </div>
                        <div class="form-group">
                            <label for="categories">دسته بندی ها(ضروری)</label>
                            <has-error :form="form" field="categories"></has-error>

                            <div :class="{ 'form-control is-invalid': form.errors.has('categories') }">
                                <tags-input element-id="categories"
                                            v-model="form.categories"
                                            :existing-tags="categories"
                                            :typeahead="typeahead"
                                            :typeahead-style="typeaheadStyle"
                                            :typeahead-max-results="typeaheadMaxResults"
                                            :typeahead-activation-threshold="typeaheadActivationThreshold"
                                            :placeholder="placeholder"
                                            :limit="limit"
                                            :only-existing-tags="onlyExistingTags"
                                            :case-sensitive-tags="caseSensitiveTags"
                                            :delete-on-backspace="deleteOnBackspace"
                                            :allow-duplicates="allowDuplicates"
                                            :add-tags-on-comma="addTagsOnComma"
                                            :add-tags-on-blur="addTagsOnBlur"
                                ></tags-input>
                            </div>
                        </div>

                        <div class="form-group">
                            <label >توضیحات(ضروری)</label>
                            <ckeditor :editor="editor" v-model="form.body" tag-name="input" name="body"
                                      :config="editorConfig" :class="{ 'form-control is-invalid': form.errors.has('body') }">
                            </ckeditor>
                            <has-error :form="form" field="body"></has-error>
                        </div>
                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">ارسال</button>
                    </div>
                </form>
            </div>
            <!-- /.card -->
        </div>
    </div>
</template>

<script>
    import ClassicEditor from '@ckeditor/ckeditor5-build-classic';

    export default {
        name: "CreateProject",

        data() {
            return {
                categories: [],
                selectedCategories: [],
                typeahead: true,
                typeaheadStyle: 'badges',
                placeholder: 'دسته بندی های مربوط به پروژه(مهارت های لازم برای تکمیل پروژه)',
                limit: 0,
                onlyExistingTags: false,
                caseSensitiveTags: false,
                deleteOnBackspace: true,
                allowDuplicates: false,
                addTagsOnComma: false,
                addTagsOnBlur: false,
                typeaheadMaxResults: 20,
                typeaheadActivationThreshold: 1,
                eventLog: '',
                editor: ClassicEditor,
                editorData: '<p></p>',
                editorConfig: {
                    toolbar: {
                        items: [
                            'bold', 'italic', 'link', 'undo', 'bulletedList', 'numberedList', 'blockQuote', 'redo'
                        ]
                    }
                },
                form: new form({
                    title: '',
                    budget: '',
                    categories: '',
                    body: '',
                })
            }
        },

        mounted() {
            axios.get('/api/categories')
                .then(({ data }) => {
                    this.categories = data
                })
        },

        methods: {
            storeProject() {
                this.form.post('/api/project')
                    .then(() => {
                        swal.fire(
                            'ساخته شد!',
                            'پروژه ساخته شد.',
                            'success'
                        );
                        this.$router.push('/projects');
                    }).catch(() => {
                        swal.fire(
                            'مشکلی پیش امد!',
                            'پروژه مورد نظر ساخته نشد.',
                            'warning'
                        )
                    })
            }
        }
    }
</script>

<style scoped>

</style>
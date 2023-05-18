<template>
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-body">
            <VeeForm
              as="div"
              v-slot="{ handleSubmit }"
              class="form-owner"
              @invalid-submit="onInvalidSubmit"
            >
              <form
                method="POST"
                @submit="handleSubmit($event, onSubmit)"
                ref="formData"
                enctype="multipart/form-data"
                :action="data.urlStore"
              >
                <Field type="hidden" :value="csrfToken" name="_token" />
                <Field type="hidden" value="PUT" name="_method" />
                <div class="form-group">
                  <div class="form-row">
                    <div class="col-6">
                      <label class="" require>Category</label>
                      <select
                        class="form-select"
                        name="category_id"
                        aria-label="Default select example"
                        rules="required"
                        v-model="model.category_id"
                      >
                        <option value disabled selected>Chọn danh muc</option>
                        <option
                          v-for="item in data.categories"
                          :key="item.id"
                          :value="item.id"
                        >
                          {{ item.label }}
                        </option>
                      </select>
                      <ErrorMessage class="error" name="category_id" />
                    </div>
                    <div class="col-6">
                      <label class="" require>Title</label>
                      <Field
                        type="text"
                        name="title"
                        autocomplete="off"
                        v-model="model.title"
                        rules="required|max:128"
                        class="form-control"
                        placeholder="Enter title"
                      />

                      <ErrorMessage class="error" name="title" />
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <div class="form-row">
                    <label class="" require>Describe</label>
                    <Field
                      type="text"
                      name="describe"
                      autocomplete="off"
                      v-model="model.describe"
                      as="textarea"
                      rules="required|max:255"
                      class="form-control"
                      placeholder="Enter Describe"
                      cols="30"
                      rows="10"
                    />
                    <ErrorMessage class="error" name="describe" />
                  </div>
                </div>

                <div class="form-group">
                  <label class="form-label" for="image">Image</label>
                  <div>
                    <div
                      class="display-image"
                      id="img-preview"
                      @click="chooseImage()"
                      role="button"
                      @dragover.prevent
                      @drop="(e) => onDrop(e)"
                    >
                      <div class="align-center-text" v-if="!filePreview">
                        <span v-if="!filePreview"
                          >Đăng ký bằng cách click hoặc kéo thả</span
                        >
                      </div>
                      <div style="display: none">
                        <input
                          :type="typeFile"
                          @change="onChange"
                          ref="fileInput"
                          accept="image/*"
                          name="image"
                          id="image"
                        />
                      </div>
                      <div class="d-flex justify-content-center">
                        <img
                          v-if="filePreview"
                          :src="filePreview"
                          class="img"
                          style="width: 300px"
                        />
                        <span
                          @click="deleteImage"
                          class="icon_delete"
                          v-if="filePreview"
                          ><i class="fa fa-trash"></i
                        ></span>
                      </div>
                      <div class="text-center mt-3">
                        <button
                          class="rounded"
                          @click="chooseImage()"
                          type="button"
                          style="display: none"
                        >
                          アップロード
                        </button>
                      </div>
                    </div>
                  </div>
                  <span class="error" v-if="hasErrImg == true">{{
                    errMsgImage
                  }}</span>
                </div>
                <div class="col-md-12 text-center btn-box">
                  <a
                    :href="data.urlBack"
                    class="btn btn-outline-secondary"
                    style="margin-right: 10px"
                  >
                    Back
                  </a>
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
              </form>
            </VeeForm>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import {
  Form as VeeForm,
  Field,
  ErrorMessage,
  defineRule,
  configure,
} from "vee-validate";
import { localize } from "@vee-validate/i18n";
import * as rules from "@vee-validate/rules";
import $ from "jquery";

export default {
  setup() {
    Object.keys(rules).forEach((rule) => {
      if (rule != "default") {
        defineRule(rule, rules[rule]);
      }
    });
  },
  components: {
    VeeForm,
    Field,
    ErrorMessage,
  },
  computed: {},
  props: ["data"],
  data: function () {
    return {
      csrfToken: Laravel.csrfToken,
      model: this.data.new,
      filePreview: "",
      typeFile: "file",
      errMsgImage: "",
      hasErrImg: false,
      categories: [],
    };
  },
  created() {
    let messError = {
      en: {
        fields: {
          title: {
            required: "The title field is required.",
            max: "The title may not be greater than 128.",
          },
          describe: {
            required: "The describe  field is required.",
            max: "The describe  may not be greater than 255.",
          },
        },
      },
    };
    configure({
      generateMessage: localize(messError),
    });
    let that = this;
    defineRule("unique_code", (value) => {
      return axios
        .post(that.data.urlCheckCode, {
          value: value,
        })
        .then(function (response) {
          return response.data.valid;
        })
        .catch((error) => {});
    });
  },
  methods: {
    deleteImage() {
      this.typeFile = "hidden";
      this.filePreview = "";
      this.media = null;
      this.ImageNotUser = 1;
      this.hasErrImg = false;
    },
    chooseImage() {
      if (this.typeFile == "hidden") {
        this.typeFile = "file";
      }
      this.$refs["fileInput"].click();
    },
    onChange(e) {
      let Image = e.target.files[0];
      if (
        Image.type.includes("image/jpeg") ||
        Image.type.includes("image/png") ||
        Image.type.includes("image/jpg")
      ) {
        this.errMsgImage = "";
        this.hasErrImg = false;
      } else {
        this.errMsgImage = "Định dạng hình ảnh không chính xác.";
        this.hasErrImg = true;
        return;
      }
      if (Image.size >= 20971520) {
        this.errMsgImage = "Ảnh quá lớn.";
        this.hasErrImg = true;
      } else {
        this.hasErrImg = false;
      }

      this.model.image = e.target.files[0];
      let fileInput = this.$refs.fileInput;
      let imgFile = fileInput.files;

      if (imgFile && imgFile[0]) {
        let reader = new FileReader();
        reader.onload = (e) => {
          this.filePreview = e.target.result;
        };
        reader.readAsDataURL(imgFile[0]);
      }
    },
    updateSelected(e) {
      let array = [];
      e.map((x) => {
        array.push(x.value);
      });
      array = [...new Set(array)];
      this.skill = array;
    },
    onInvalidSubmit({ values, errors, results }) {
      let firstInputError = Object.entries(errors)[0][0];
      this.$el.querySelector("input[name=" + firstInputError + "]").focus();
      $("html, body").animate(
        {
          scrollTop:
            $("input[name=" + firstInputError + "]").offset().top - 150,
        },
        500
      );
    },
    onSubmit() {
      this.$refs.formData.submit();
    },
  },
};
</script>



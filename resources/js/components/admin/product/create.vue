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
                <div class="form-group">
                  <div class="form-row">
                    <div class="col-6">
                      <label class="" require>Product Name</label>
                      <Field
                        type="text"
                        name="product_name"
                        autocomplete="off"
                        v-model="model.product_name"
                        rules="required|max:128"
                        class="form-control"
                        placeholder="Enter product name"
                      />

                      <ErrorMessage class="error" name="product_name" />
                    </div>
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
                  </div>
                </div>
                <div class="form-group">
                  <div class="form-row">
                    <div class="col-6">
                      <label class="" require>Product Code</label>
                      <Field
                        type="text"
                        name="product_code"
                        autocomplete="off"
                        v-model="model.product_code"
                        rules="required|max:128|unique_code"
                        class="form-control"
                        placeholder="Enter product code"
                      />

                      <ErrorMessage class="error" name="product_code" />
                    </div>
                    <div class="col-6">
                      <label class="" require>Root</label>
                      <Field
                        type="text"
                        name="root"
                        autocomplete="off"
                        v-model="model.root"
                        rules="required|max:128"
                        class="form-control"
                        placeholder="Enter Root"
                      />

                      <ErrorMessage class="error" name="root" />
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <div class="form-row">
                    <div class="col-4">
                      <label class="" require>Buying Price</label>
                      <Field
                        type="number"
                        name="buying_price"
                        autocomplete="off"
                        v-model="model.buying_price"
                        rules="required|max:128"
                        class="form-control"
                        placeholder="Enter buying price"
                      />

                      <ErrorMessage class="error" name="buying_price" />
                    </div>
                    <div class="col-4">
                      <label class="" require>Selling Price</label>
                      <Field
                        type="number"
                        name="selling_price"
                        autocomplete="off"
                        v-model="model.selling_price"
                        rules="required|max:128"
                        class="form-control"
                        placeholder="Enter selling price"
                      />

                      <ErrorMessage class="error" name="selling_price" />
                    </div>
                    <div class="col-4">
                      <label class="" require>Buying Date</label>
                      <Field
                        type="date"
                        name="buying_date"
                        autocomplete="off"
                        v-model="model.buying_date"
                        rules="required"
                        class="form-control"
                        placeholder="Enter buying date"
                      />

                      <ErrorMessage class="error" name="buying_date" />
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <div class="form-row">
                    <div class="col-6">
                      <label class="" require>Product Quantity</label>
                      <Field
                        type="text"
                        name="product_quantity"
                        autocomplete="off"
                        v-model="model.product_quantity"
                        rules="required|min_value:1"
                        class="form-control"
                        placeholder="Enter product quantity"
                      />

                      <ErrorMessage class="error" name="product_quantity" />
                    </div>
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

      model: {
        category_id: "",
        product_name: "",
        product_code: "",
        root: "",
        buying_price: "",
        selling_price: "",
        buying_date: "",
        product_quantity: "",
      },
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
          product_name: {
            required: "The product_name field is required.",
            max: "The product_name may not be greater than 128.",
          },
          root : {
            required: "The root  field is required.",
            max: "The root  may not be greater than 128.",
          },
          buying_price: {
            required: "The buying_price field is required.",
            max: "The buying_price may not be greater than 128.",
          },
          selling_price: {
            required: "The selling_price field is required.",
            max: "The selling_price may not be greater than 128.",
          },
          buying_date: {
            required: "The buying_date  field is required.",
            max: "The buying_date  may not be greater than 128.",
          },
          product_code: {
            required: "The product_code field is required.",
            max: "The product_code may not be greater than 128.",
            unique_code: "The product_code field is already exists "
          },
          product_quantity: {
            required: "The product_quantity field is required.",
            min_value: "The product_quantity must be at least 1.",
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



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
                :action="data.urlUpdate"
              >
                <Field type="hidden" :value="csrfToken" name="_token" />
                <Field type="hidden" value="PUT" name="_method" />
                <div class="form-group">
                  <label class="" require>Name</label>
                  <Field
                    type="text"
                    name="name"
                    autocomplete="off"
                    v-model="model.name"
                    rules="required|max:128"
                    class="form-control"
                    placeholder="Enter Name"
                  />

                  <ErrorMessage class="error" name="name" />
                </div>
                <div class="form-group">
                  <label class="" require>Email</label>
                  <Field
                    type="text"
                    name="email"
                    autocomplete="off"
                    v-model="model.email"
                    rules="required|max:128|email|unique_email"
                    class="form-control"
                    placeholder="Enter email"
                  />

                  <ErrorMessage class="error" name="email" />
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

      model: this.data.user,
    };
  },
  created() {
    let messError = {
      en: {
        fields: {
          name: {
            required: "The name field is required.",
            max: "The name may not be greater than 128.",
          },
          email: {
            required: "The email field is required.",
            max: "The email may not be greater than 128.",
            unique_email: "The email already exists",
            email: "The Email must be a valid email address.",
          },
          password: {
            required: "The password field is required.",
            max: "The password may not be greater than 128.",
          },
        },
      },
    };
    configure({
      generateMessage: localize(messError),
    });
    let that = this;
    defineRule("unique_email", (value) => {
      return axios
        .post(that.data.urlCheckEmail, {
          value: value,
          id: that.data.user.id,
        })
        .then(function (response) {
          return response.data.valid
        })
        .catch((error) => {});
    });
  },
  methods: {
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



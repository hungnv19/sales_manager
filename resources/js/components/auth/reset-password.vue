<template>
  <section class="vh-100">
    <div class="container-fluid h-custom">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-md-9 col-lg-6 col-xl-5">
          <img
            src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-login-form/draw2.webp"
            class="img-fluid"
            alt="Sample image"
          />
        </div>
        <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
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

              
              <div class="form-outline mb-3">
                <label class="" require>Password</label>
                <Field
                  type="password"
                  name="password"
                  autocomplete="off"
                  v-model="model.password"
                  rules="required|max:128"
                  class="form-control"
                  placeholder="Enter password"
                />

                <ErrorMessage class="error" name="password" />
              </div>
              <div class="form-outline mb-3">
                <label class="" require>Password Confirm</label>
                <Field
                  type="password"
                  name="password_confirm"
                  autocomplete="off"
                  v-model="model.password_confirm"
                  rules="required|max:128"
                  class="form-control"
                  placeholder="Enter password_confirm"
                />

                <ErrorMessage class="error" name="password_confirm" />
              </div>

              <div class="text-center text-lg-start mt-4 pt-2">
                <button
                  type="submit"
                  class="btn btn-primary btn-lg"
                  style="padding-left: 2.5rem; padding-right: 2.5rem"
                >
                  Chang Pass
                </button>
              </div>
            </form>
          </VeeForm>
        </div>
      </div>
    </div>
  </section>
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
        password_confirm: "",
        password: "",
      },
    };
  },
  created() {
    let messError = {
      en: {
        fields: {
          password_confirm: {
            required: "The password_confirm field is required.",
            max: "The password_confirm may not be greater than 128.",
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

<style scoped>
.divider:after,
.divider:before {
  content: "";
  flex: 1;
  height: 1px;
  background: #eee;
}
.h-custom {
  height: calc(100% - 73px);
}
@media (max-width: 450px) {
  .h-custom {
    height: 100%;
  }
}
</style>

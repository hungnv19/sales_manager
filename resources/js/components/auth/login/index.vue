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
              <div
                class="d-flex flex-row align-items-center justify-content-center justify-content-lg-start"
              >
                <p class="lead fw-normal mb-0 me-3">Sign in with</p>
                <button type="button" class="btn btn-primary btn-floating mx-1">
                  <i class="fab fa-facebook-f"></i>
                </button>

                <button type="button" class="btn btn-primary btn-floating mx-1">
                  <i class="fab fa-twitter"></i>
                </button>

                <button type="button" class="btn btn-primary btn-floating mx-1">
                  <i class="fab fa-linkedin-in"></i>
                </button>
              </div>

              <div class="divider d-flex align-items-center my-4">
                <p class="text-center fw-bold mx-3 mb-0">Or</p>
              </div>

              <!-- Email input -->
              <div class="form-outline mb-4">
                <label class="" require>Email</label>
                <Field
                  type="text"
                  name="email"
                  autocomplete="off"
                  v-model="model.email"
                  rules="required|max:128"
                  class="form-control"
                  placeholder="Enter email"
                />

                <ErrorMessage class="error" name="email" />
              </div>

              <!-- Password input -->
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
              <div class="form-group">
                <div class="d-flex justify-content-center">
                  <div class="text-danger" v-if="showError">
                    {{ messageError }}
                  </div>
                </div>
              </div>
              <div class="d-flex justify-content-between align-items-center">
                <!-- Checkbox -->
                <div class="form-check mb-0">
                  <input
                    class="form-check-input me-2"
                    type="checkbox"
                    value=""
                    id="form2Example3"
                  />
                  <label class="form-check-label" for="form2Example3">
                    Remember me
                  </label>
                </div>
                <a href="#!" class="text-body">Forgot password?</a>
              </div>

              <div class="text-center text-lg-start mt-4 pt-2">
                <button
                  type="submit"
                  class="btn btn-primary btn-lg"
                  style="padding-left: 2.5rem; padding-right: 2.5rem"
                >
                  Login
                </button>
                <p class="small fw-bold mt-2 pt-1 mb-0">
                  Don't have an account?
                  <a :href="data.urlRegister" class="link-danger">Register</a>
                </p>
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
      showError: false,
      messageError: null,
      model: {
        email: "",
        password: "",
      },
    };
  },
  created() {
    let messError = {
      en: {
        fields: {
          email: {
            required: "The email field is required.",
            max: "The email may not be greater than 128.",
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

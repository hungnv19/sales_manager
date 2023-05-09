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
                <div class="form-group">
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

                <div class="col-md-12 text-center btn-box">
                  <a
                    :href="data.urlRegister"
                    class="btn btn-outline-secondary"
                    style="margin-right: 10px"
                  >
                    Register
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
      // let that = this;
      // axios
      //   .post(that.data.urlUserLogin)
      //   .then((res) => {
      //     if (res.data.error) {
      //       that.messageError = res.data.error;
      //       that.showError = true;
      //     }
      //   })
      //   .catch((res) => {
      //     this.errors = res.response.data.res;
      //   });
      this.$refs.formData.submit();
    },
  },
};
</script>



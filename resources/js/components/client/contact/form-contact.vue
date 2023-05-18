<template>
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
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
                <div class="col-lg-6">
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
                <div class="col-lg-6">
                  <label class="" require>Email</label>
                  <Field
                    type="text"
                    name="email"
                    autocomplete="off"
                    v-model="model.email"
                    rules="required|max:128"
                    class="form-control"
                    placeholder="Enter Email"
                  />

                  <ErrorMessage class="error" name="email" />
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="form-row">
                <div class="col-lg-6">
                  <label class="" require>Phone</label>
                  <Field
                    type="number"
                    name="phone"
                    autocomplete="off"
                    v-model="model.phone"
                    rules="required"
                    class="form-control"
                    placeholder="Enter Phone"
                  />

                  <ErrorMessage class="error" name="phone" />
                </div>
                <div class="col-lg-6">
                  <label class="" require>Subject</label>
                  <Field
                    type="text"
                    name="subject"
                    autocomplete="off"
                    v-model="model.subject"
                    rules="required|max:128"
                    class="form-control"
                    placeholder="Enter Subject"
                  />

                  <ErrorMessage class="error" name="subject" />
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="">
                <label class="" require>Message</label>
                <Field
                  type="text"
                  name="message"
                  autocomplete="off"
                  v-model="model.message"
                  as="textarea"
                  rules="required|max:255"
                  class="form-control"
                  placeholder="Enter Message"
                  cols="30"
                  rows="10"
                />
                <ErrorMessage class="error" name="message" />
              </div>
            </div>

            <div class="col-md-12 text-center btn-box">
              <button type="submit" class="site-btn">Send Message</button>
            </div>
          </form>
        </VeeForm>
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
        name: "",
        email: "",
        phone: "",
        subject: "",
        message: "",
      },
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
          },
          phone: {
            required: "The phone field is required.",
          },
          subject: {
            required: "The subject field is required.",
            max: "The subject may not be greater than 128.",
          },
          message: {
            required: "The message field is required.",
            max: "The message may not be greater than 255.",
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



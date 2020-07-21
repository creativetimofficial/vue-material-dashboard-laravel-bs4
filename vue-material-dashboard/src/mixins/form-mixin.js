import {isEmpty, isEqual, omit, pick} from 'lodash';

export default {
  data() {
    return {
      isLoading: false,
      apiValidationErrors: {}
    };
  },
  methods: {
    /* extract API server validation errors and assigns them to local mixin data */
    setApiValidation(serverErrors, refs = null) {
      this.apiValidationErrors = serverErrors.reduce(
        (accumulator, errorObject) => {
          const errorFieldName = errorObject.source.pointer.split('/')[3];
          const errorDetail = (accumulator[errorFieldName] || []).concat(errorObject.detail);

          return {
            ...accumulator,
            [errorFieldName]: errorDetail
          };
        },
        {}
      );
    },

    /* resets form after success */
    resetForm() {
      // Reset attributes
      for (const key in this.form.data.attributes) {
        if (this.form.data.attributes.hasOwnProperty(key)) {
          this.form.data.attributes[key] = null;
        }
      }

      // Reset relationships if exist
      if (this.form.data.hasOwnProperty('relationships')) {
        for (const key in this.form.data.relationships) {
          if (this.form.data.relationships.hasOwnProperty(key)) {
            this.form.data.relationships[key].data.id = null;
          }
        }
      }

      // Reset validation errors
      // this.$v.$reset();

      // reset Loading status
      this.isLoading = false;
    },

    checkFormIsDirty(oldData, newData) {
      if (isEmpty(oldData)) {
        let relationshipIds = [];
        newData = omit(newData, ['id', 'type']);

        if (newData.hasOwnProperty('relationshipNames')) {
          const relationships = pick(newData, newData.relationshipNames);
          relationshipIds = Object.values(relationships).map((i) => i.id);
          newData = omit(newData, [
            ...Object.keys(relationships),
            'relationshipNames'
          ]);
        }

        return (
          Object.values(newData).filter((item) => !isEmpty(item)).length ||
          relationshipIds.filter((item) => !isEmpty(item)).length
        );
      }

      return !isEqual(oldData, newData);
    }
  }
};

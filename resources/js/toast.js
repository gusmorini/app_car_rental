import { Toast } from "bootstrap";

export const toast = ({ title, message }) => {
    // html modelo toast
    const toastModel = `
      <div class="toast" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header">
          <strong class="me-auto">${title}</strong>
          <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body">
          ${message}
        </div>
      </div>
    `;
    // insere o html no container
    document.querySelector("#toast-container").innerHTML = toastModel;
    // cria uma instancia do toast
    let toast = new Toast(document.querySelector(".toast"), { delay: 3000 });
    // executa o toast após 500ms
    setTimeout(() => toast.show(), 500);
};

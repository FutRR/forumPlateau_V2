function onClick(e) {
  e.preventDefault();
  grecaptcha.enterprise.ready(async () => {
    const token = await grecaptcha.enterprise.execute(
      "6LfNf7UpAAAAAJV6fAjEP3zGE5GiL_LOj-726OcP",
      { action: "LOGIN" }
    );
  });
}

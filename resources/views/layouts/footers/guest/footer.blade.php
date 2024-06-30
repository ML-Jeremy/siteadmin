  <!-- -------- START FOOTER 3 w/ COMPANY DESCRIPTION WITH LINKS & SOCIAL ICONS & COPYRIGHT ------- -->
  <footer class="footer py-5">
    <div class="container">
      <div class="row">
      <div class="col-lg-8 mb-4 mx-auto text-center">
          <a href="index.php" target="_blank" class="text-secondary me-xl-5 me-3 mb-sm-0 mb-2">
              Accueil
          </a>
          <a href="prestation.php" target="_blank" class="text-secondary me-xl-5 me-3 mb-sm-0 mb-2">
              Prestation
          </a>
          <a href="tarifs.php" target="_blank" class="text-secondary me-xl-5 me-3 mb-sm-0 mb-2">
              Tarifs
          </a>
          <a href="contact.php" target="_blank" class="text-secondary me-xl-5 me-3 mb-sm-0 mb-2">
              Contacts
          </a>
      </div>
        @if (!auth()->user() || \Request::is('static-sign-up'))
          <div class="col-lg-8 mx-auto text-center mb-4 mt-2">
              <a href="https://ro.pinterest.com/thecreativetim/" target="_blank" class="text-secondary me-xl-4 me-4">
                  <span class="text-lg fab fa-linkedin" aria-hidden="true"></span>
              </a>
          </div>
        @endif
      </div>
      @if (!auth()->user() || \Request::is('static-sign-up'))
        <div class="row">
          <div class="col-8 mx-auto text-center mt-1">
            <p class="mb-0 text-secondary">
              Copyright © <script>
                document.write(new Date().getFullYear())
              </script> Développé par
              <a style="color: #252f40;" href="#" class="font-weight-bold ml-1" target="_blank">Software Entreprise</a>
            </p>
          </div>
        </div>
      @endif
    </div>
  </footer>
  <!-- -------- END FOOTER 3 w/ COMPANY DESCRIPTION WITH LINKS & SOCIAL ICONS & COPYRIGHT ------- -->

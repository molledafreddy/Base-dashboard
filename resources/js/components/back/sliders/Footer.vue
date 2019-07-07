<template>
  <div class="slim-footer">
    <div class="container">
      <p>Copyright 2018 &copy; All Rights Reserved. Tobal Systems CA</p>
      <p>Designed by: <a href="#">tobalsystems.com</a></p>
    </div><!-- container -->
  </div><!-- slim-footer -->
</template>
<script>
    export default{
     data(){
            return{
                root:null,
                style:false,
            }
        },
    }
</script>


<style type="text/css">
  

  .slim-footer {
  border-top: 1px solid #ced4da;
  background-color: #e3e7eb;
  margin-top: 30px;
  padding: 15px 0; }
  @media (min-width: 992px) {
    .slim-footer {
      margin-top: 50px;
      padding: 0; } }
  .slim-footer .container,
  .slim-footer .container-fluid {
    font-size: 13px;
    text-align: center; }
    @media (min-width: 768px) {
      .slim-footer .container,
      .slim-footer .container-fluid {
        height: 60px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        text-align: left; } }
    .slim-footer .container p,
    .slim-footer .container-fluid p {
      margin-bottom: 0; }
      .slim-footer .container p:last-child,
      .slim-footer .container-fluid p:last-child {
        margin-top: 5px; }
  @media (min-width: 992px) {
    .slim-footer .container-fluid {
      padding-left: 25px;
      padding-right: 25px; } }
</style>

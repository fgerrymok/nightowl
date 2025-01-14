document.addEventListener("DOMContentLoaded", () => {
  const fabMain = document.getElementById("fab-main");
  const fabMenu = document.getElementById("fab-menu");
  const fabClose = document.getElementById("fab-close");

  // FAB 클릭 시 메뉴 열기
  fabMain.addEventListener("click", () => {
    fabMain.classList.add("hidden");
    fabMenu.classList.remove("hidden");
  });

  // 닫기 버튼 클릭 시 메뉴 닫기
  fabClose.addEventListener("click", () => {
    fabMenu.classList.add("hidden");
    fabMain.classList.remove("hidden");
  });
});

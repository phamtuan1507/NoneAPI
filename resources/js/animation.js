document.addEventListener('DOMContentLoaded', () => {
  const textGroup = document.getElementById('rotating-text');
  let rotation = 0;
  const speed = 0.5; // tốc độ quay (độ mỗi frame)

  function animate() {
    rotation = (rotation + speed) % 360;
    textGroup.setAttribute('transform', `rotate(${rotation} 64 64)`); // quay quanh tâm 64,64
    requestAnimationFrame(animate);
  }

  animate();
});

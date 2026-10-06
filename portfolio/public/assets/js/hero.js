/**
 * Hero Interactive Media
 * Handles hover & click preview for the hero showcase video
 */
document.addEventListener('DOMContentLoaded', () => {
  const mediaBtn = document.querySelector('.daya-hero-media');
  if (!mediaBtn) return;

  const video = mediaBtn.querySelector('.daya-hero-media__video');
  if (!video) return;

  const playVideo = () => {
    mediaBtn.classList.add('is-playing');
    mediaBtn.setAttribute('aria-pressed', 'true');
    const playPromise = video.play();
    if (playPromise !== undefined) {
      playPromise.catch(() => {
        // Autoplay policy prevented playback; remain on poster
      });
    }
  };

  const pauseVideo = () => {
    mediaBtn.classList.remove('is-playing');
    mediaBtn.setAttribute('aria-pressed', 'false');
    video.pause();
    video.currentTime = 0;
  };

  // Hover on desktop
  mediaBtn.addEventListener('mouseenter', playVideo);
  mediaBtn.addEventListener('mouseleave', pauseVideo);

  // Click / tap toggle for mobile and touch devices
  mediaBtn.addEventListener('click', () => {
    if (video.paused) {
      playVideo();
    } else {
      pauseVideo();
    }
  });
});

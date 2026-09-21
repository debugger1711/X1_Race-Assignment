"""Generate cinematic placeholder JPEGs for StarVista sample posts."""
from __future__ import annotations

import hashlib
from pathlib import Path

from PIL import Image, ImageDraw, ImageFilter, ImageFont

ROOT = Path(__file__).resolve().parents[1]
SEED = ROOT / "wp-content" / "uploads" / "starvista-seed"
UPLOADS = ROOT / "wp-content" / "uploads"


def palette(seed: str) -> tuple[tuple[int, int, int], tuple[int, int, int], tuple[int, int, int]]:
    h = hashlib.md5(seed.encode()).hexdigest()
    palettes = [
        ((12, 12, 14), (255, 45, 107), (40, 18, 28)),
        ((8, 16, 32), (245, 197, 24), (18, 40, 70)),
        ((20, 8, 28), (220, 90, 170), (60, 20, 80)),
        ((6, 28, 32), (40, 190, 170), (10, 60, 70)),
        ((28, 10, 10), (230, 90, 50), (80, 24, 18)),
        ((10, 12, 28), (120, 150, 255), (30, 36, 80)),
        ((18, 18, 18), (240, 240, 240), (70, 70, 70)),
        ((36, 18, 8), (255, 170, 70), (110, 55, 20)),
    ]
    return palettes[int(h[:2], 16) % len(palettes)]


def font(size: int):
    for name in ("arialbd.ttf", "segoeuib.ttf", "arial.ttf", "segoeui.ttf"):
        path = Path(r"C:\Windows\Fonts") / name
        if path.exists():
            return ImageFont.truetype(str(path), size)
    return ImageFont.load_default()


def render(path: Path, title: str) -> None:
    w, h = 1200, 750
    dark, accent, mid = palette(path.stem)
    img = Image.new("RGB", (w, h), dark)
    overlay = Image.new("RGB", (w, h), mid)
    draw_ov = ImageDraw.Draw(overlay)
    draw_ov.ellipse((700, -80, 1400, 620), fill=accent)
    draw_ov.rectangle((0, 470, w, h), fill=accent)
    overlay = overlay.filter(ImageFilter.GaussianBlur(48))
    img = Image.blend(img, overlay, 0.55)
    draw = ImageDraw.Draw(img)
    draw.rectangle((0, 0, 16, h), fill=accent)
    draw.rectangle((64, 72, 420, 92), fill=accent)
    draw.text((72, 640), "STARVISTA", font=font(22), fill=(255, 255, 255))
    path.parent.mkdir(parents=True, exist_ok=True)
    img.save(path, "JPEG", quality=86, optimize=True)


def main() -> None:
    files = list(SEED.glob("*.jpg"))
    if not files:
        raise SystemExit(f"No seed images in {SEED}")
    for src in files:
        render(src, src.stem.replace("-", " "))
        # overwrite matching uploads copies
        for dest in UPLOADS.rglob(src.name):
            if dest == src:
                continue
            dest.write_bytes(src.read_bytes())
        print("updated", src.name)


if __name__ == "__main__":
    main()

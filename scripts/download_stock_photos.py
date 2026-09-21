"""Download royalty-free Unsplash photos and replace StarVista featured images."""
from __future__ import annotations

import urllib.request
from pathlib import Path

ROOT = Path(r"C:\Users\visha\OneDrive\Desktop\X1_Race Assignment")
DEST = ROOT / "wp-content" / "uploads" / "2026" / "09"
SEED = ROOT / "wp-content" / "uploads" / "starvista-seed"
STOCK = ROOT / "wp-content" / "uploads" / "starvista-stock"

# Curated Unsplash photos (Unsplash License). Mapped to article slugs.
PHOTOS = {
    "midnight-premiere-ensemble-drama": "1485846234645-a62644f54746",
    "top-celebrity-looks-this-week": "1469334031218-e382a71b716b",
    "archive-gown-comeback": "1515886657613-9f3515b0c78f",
    "airport-style-elevated": "1483985988355-763728e1935b",
    "mens-red-carpet-tailoring": "1507679799987-c73779587ccf",
    "stylist-capsule-wardrobe": "1496747611176-843222e1e57c",
    "on-set-breakout-music-video": "1493225457124-a3eb161ffa5f",
    "trailer-breakdown-spy-thriller": "1440404653325-ab127d49abc1",
    "dance-rehearsal-diaries": "1508700115892-45ecd05ae2ad",
    "festival-diary-breakout-director": "1478147427282-58a87a120781",
    "inside-variety-hour-late-night": "1522869635100-9f4c5e86aa37",
    "micro-budget-short-shared-clip": "1492691527719-9d1e07e534b4",
    "harbour-lights-review": "1489599849927-2ee91cede3ba",
    "north-line-review": "1536440136628-849c177e76a1",
    "saffron-circuit-review": "1461896836934-ffe607ba6851",
    "five-upcoming-studio-films": "1594909122845-11baa66b0497",
    "box-office-mid-budget-dramas": "1517604931442-7e0c8ed2963c",
    "composer-explains-the-hook": "1511671782779-c97d3d27a1d4",
    "hollywood-watchlist-this-month": "1478720568477-1520c2f6b5d4",
    "awards-race-front-runner": "1514525253161-7a46d19cd819",
    "costume-designer-1970s-newsroom": "1558769132-cb1aea3c8565",
    "tv-shows-trending-right-now": "1574375927938-d5a98e8ffe85",
    "writers-room-sitcom-turnaround": "1516321318423-f06f85e504b3",
    "reality-tv-new-golden-rule": "1586899028174-e7098604235b",
    "south-cinema-releases-this-month": "1574267432553-4b4628081c31",
    "cinematographer-night-markets": "1540959733332-eab4deabeeaf",
    "regional-studio-franchise": "1485846234645-a62644f54746",
    "best-fashion-trends-this-season": "1509631179647-0177331693ae",
    "style-tips-working-wardrobe-teams": "1529139574466-a303027c1d2b",
    "fashion-news-independent-ateliers": "1558611848-73f7eb4001a1",
    "latest-beauty-trends-making-waves": "1487412947147-5cebf100ffc2",
    "makeup-artist-kit-call-times": "1522335789203-aabd1fc54bc9",
    "hair-softer-texture-replacing-blowout": "1560066984-138dadb4c035",
    "skincare-barrier-repair": "1556228720-195a672e8a03",
    "health-night-shoot-endurance": "1544367567-0f2fcb009e0b",
    "fitness-habits-stunt-teams": "1517836357463-d25dfeac3438",
    "food-recovery-festival-weeks": "1490645935967-10de6ba17061",
    "sleep-science-late-workers": "1541781774459-bb2af2f05b55",
    "korean-wave-series-recommending": "1517154421773-0529f29ea451",
    "k-fashion-soft-tailoring": "1539109136881-3be0616acf4b",
    "idol-comeback-week-craft": "1501281668745-f2f8ba5b1cf7",
    "korean-cinema-family-film": "1538485399081-719c1ddf4507",
    "lifestyle-screening-night": "1595769816263-8e2051566791",
    "weekend-cities-crews-wrap-early": "1414235077428-338989a2e8c0",
    "prop-master-collection": "1478720568477-1520c2f6b5d4",
}

# Extra Unsplash IDs if a download fails.
FALLBACKS = [
    "1500530855697-b586d89ba3ee",
    "1489599849927-2ee91cede3ba",
    "1529626455594-4ff0802cfb7e",
    "1494790108377-be9c29b29330",
    "1524504388940-b1c1722653e1",
    "1534528741775-53994a69daeb",
    "1469474968028-56623f02e42e",
    "1500534314209-a25ddb2bd429",
    "1519741497674-611481863552",
    "1497032628192-86f99bcd76bc",
    "1501785888041-af3ef285b470",
    "1470229722913-7c0e2dbbafd3",
    "1487412720507-e7ab37603c6f",
    "1515377905703-c4788e51af15",
    "1522335789203-aabd1fc54bc9",
]


def url_for(photo_id: str) -> str:
    return f"https://images.unsplash.com/photo-{photo_id}?auto=format&fit=crop&w=1400&h=880&q=80"


def download(photo_id: str, target: Path) -> bool:
    req = urllib.request.Request(
        url_for(photo_id),
        headers={
            "User-Agent": "Mozilla/5.0 (Windows NT 10.0; Win64; x64) StarVista/1.0",
            "Accept": "image/jpeg,image/*,*/*",
        },
    )
    try:
        with urllib.request.urlopen(req, timeout=30) as resp:
            data = resp.read()
        if len(data) < 8000:
            print("too small", photo_id, len(data))
            return False
        target.parent.mkdir(parents=True, exist_ok=True)
        target.write_bytes(data)
        print("ok", target.name, len(data))
        return True
    except Exception as exc:
        print("fail", photo_id, exc)
        return False


def main() -> None:
    STOCK.mkdir(parents=True, exist_ok=True)
    SEED.mkdir(parents=True, exist_ok=True)
    DEST.mkdir(parents=True, exist_ok=True)
    fb = 0
    for slug, photo_id in PHOTOS.items():
        stock = STOCK / f"{slug}.jpg"
        ok = download(photo_id, stock)
        while not ok and fb < len(FALLBACKS):
            ok = download(FALLBACKS[fb], stock)
            fb += 1
        if not ok:
            print("SKIP", slug)
            continue
        data = stock.read_bytes()
        (SEED / f"{slug}.jpg").write_bytes(data)
        (DEST / f"{slug}.jpg").write_bytes(data)


if __name__ == "__main__":
    main()

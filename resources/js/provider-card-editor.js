const CANVAS_SIZE = 1080;

function wrapText(ctx, text, maxWidth) {
    const lines = [];
    text.split('\n').forEach((paragraph) => {
        if (paragraph.trim() === '') {
            lines.push('');
            return;
        }
        const words = paragraph.split(' ');
        let line = '';
        words.forEach((word) => {
            const test = line ? `${line} ${word}` : word;
            if (ctx.measureText(test).width > maxWidth && line) {
                lines.push(line);
                line = word;
            } else {
                line = test;
            }
        });
        lines.push(line);
    });
    return lines;
}

function roundRectPath(ctx, x, y, w, h, radii) {
    const r = typeof radii === 'number' ? { tl: radii, tr: radii, br: radii, bl: radii } : radii;
    ctx.beginPath();
    ctx.moveTo(x + r.tl, y);
    ctx.lineTo(x + w - r.tr, y);
    ctx.arcTo(x + w, y, x + w, y + r.tr, r.tr);
    ctx.lineTo(x + w, y + h - r.br);
    ctx.arcTo(x + w, y + h, x + w - r.br, y + h, r.br);
    ctx.lineTo(x + r.bl, y + h);
    ctx.arcTo(x, y + h, x, y + h - r.bl, r.bl);
    ctx.lineTo(x, y + r.tl);
    ctx.arcTo(x, y, x + r.tl, y, r.tl);
    ctx.closePath();
}

// Proper filled (Heroicons "solid") SVG icon paths — crisper and more polished on a
// coloured badge than thin outline strokes. `rule` marks paths that need evenodd fill
// (shapes with a cut-out, e.g. the monitor bezel).
const ICONS = {
    pin: {
        path: 'M9.69 18.933l.003.001C9.89 19.033 10 19 10 19s.11.033.308-.066l.002-.001.006-.003.018-.01a5.7 5.7 0 00.281-.162c.186-.113.446-.278.757-.493.62-.43 1.44-1.05 2.26-1.82C15.26 14.919 17 12.689 17 10a7 7 0 10-14 0c0 2.689 1.74 4.919 3.368 6.445.82.771 1.64 1.391 2.26 1.82.311.215.571.38.757.493a5.7 5.7 0 00.281.162l.018.01.006.003zM10 12.5a2.5 2.5 0 100-5 2.5 2.5 0 000 5z',
        rule: 'evenodd',
    },
    monitor: {
        path: 'M2.25 5.25a3 3 0 013-3h13.5a3 3 0 013 3V15a3 3 0 01-3 3h-3v.257c0 .597.237 1.17.659 1.591l.621.622a.75.75 0 01-.53 1.28h-9a.75.75 0 01-.53-1.28l.621-.622a2.25 2.25 0 00.659-1.59V18h-3a3 3 0 01-3-3V5.25zm1.5 0v7.5a1.5 1.5 0 001.5 1.5h13.5a1.5 1.5 0 001.5-1.5v-7.5a1.5 1.5 0 00-1.5-1.5H5.25a1.5 1.5 0 00-1.5 1.5z',
        rule: 'evenodd',
        viewBox: 24,
    },
    clock: {
        path: 'M10 18a8 8 0 100-16 8 8 0 000 16zm.75-13a.75.75 0 00-1.5 0v5c0 .414.336.75.75.75h4a.75.75 0 000-1.5h-3.25V5z',
        rule: 'evenodd',
    },
};

/** Draws a solid (filled) vector icon in a `size`x`size` box, top-left at x,y. */
function drawIcon(ctx, name, x, y, size, color) {
    const icon = ICONS[name];
    const viewBox = icon.viewBox || 20;
    const path = new Path2D(icon.path);
    ctx.save();
    ctx.translate(x, y);
    ctx.scale(size / viewBox, size / viewBox);
    ctx.fillStyle = color;
    if (icon.rule) {
        ctx.fill(path, icon.rule);
    } else {
        ctx.fill(path);
    }
    ctx.restore();
}

/** Draws a centered row of icon badges, wrapping to multiple rows if needed. Returns the y position after the row(s). */
function drawBadgeRow(ctx, badges, centerX, y, maxWidth, { font, gap = 14, padX = 22, iconSize = 18, height = 46 }) {
    ctx.font = font;
    ctx.textAlign = 'left';
    ctx.textBaseline = 'middle';

    const measured = badges.map((b) => ({
        ...b,
        w: ctx.measureText(b.text).width + padX * 2 + iconSize + padX * 0.5,
    }));

    const rows = [];
    let row = [];
    let rowWidth = 0;
    measured.forEach((b) => {
        const addWidth = b.w + (row.length ? gap : 0);
        if (rowWidth + addWidth > maxWidth && row.length) {
            rows.push(row);
            row = [];
            rowWidth = 0;
        }
        row.push(b);
        rowWidth += b.w + (row.length > 1 ? gap : 0);
    });
    if (row.length) rows.push(row);

    let cursorY = y;
    rows.forEach((r) => {
        const totalWidth = r.reduce((sum, b) => sum + b.w, 0) + gap * (r.length - 1);
        let x = centerX - totalWidth / 2;
        r.forEach((b) => {
            ctx.fillStyle = b.bg;
            roundRectPath(ctx, x, cursorY, b.w, height, height / 2);
            ctx.fill();
            drawIcon(ctx, b.icon, x + padX, cursorY + height / 2 - iconSize / 2, iconSize, b.color);
            ctx.fillStyle = b.color;
            ctx.fillText(b.text, x + padX + iconSize + padX * 0.5, cursorY + height / 2 + 1);
            x += b.w + gap;
        });
        cursorY += height + gap;
    });

    return cursorY - gap;
}

export default function providerCoverCard(provider) {
    return {
        heading: 'Welcome to Kids Health Hub',
        headingFont: "'Dancing Script', cursive",
        headingColor: '#ffffff',
        body: provider.bio || '',
        bodyFont: "'Nunito', sans-serif",
        backgroundColor: '#0d9488',
        showLocation: true,
        showTelehealth: true,
        showWaitTime: true,
        showCategory: true,
        providerImg: null,

        init() {
            const canvas = this.$refs.canvas;
            canvas.width = CANVAS_SIZE;
            canvas.height = CANVAS_SIZE;

            if (provider.profileImageUrl) {
                const img = new Image();
                img.crossOrigin = 'anonymous';
                img.onload = () => { this.providerImg = img; this.draw(); };
                img.src = provider.profileImageUrl;
            }
            const fonts = ["700 40px 'Dancing Script'", "40px 'Pacifico'", "700 40px 'Caveat'", "bold 16px 'Nunito'", "16px 'Nunito'"];
            Promise.all(fonts.map((f) => document.fonts.load(f))).finally(() => this.draw());
        },

        draw() {
            const canvas = this.$refs.canvas;
            if (!canvas) return;
            const ctx = canvas.getContext('2d');
            const { width, height } = canvas;

            // Solid brand-colour field behind everything
            ctx.fillStyle = this.backgroundColor;
            ctx.fillRect(0, 0, width, height);

            const heroHeight = height * 0.46;
            this.drawHero(ctx, width, heroHeight);
            this.drawContent(ctx, width, height, heroHeight);
        },

        drawHero(ctx, width, heroHeight) {
            ctx.save();
            ctx.beginPath();
            ctx.rect(0, 0, width, heroHeight);
            ctx.clip();

            if (this.providerImg) {
                const imgRatio = this.providerImg.width / this.providerImg.height;
                const boxRatio = width / heroHeight;
                let dw = width, dh = heroHeight, dx = 0, dy = 0;
                if (imgRatio > boxRatio) {
                    dh = heroHeight;
                    dw = heroHeight * imgRatio;
                    dx = -(dw - width) / 2;
                } else {
                    dw = width;
                    dh = width / imgRatio;
                    dy = -(dh - heroHeight) / 2;
                }
                ctx.drawImage(this.providerImg, dx, dy, dw, dh);
            } else {
                const gradient = ctx.createLinearGradient(0, 0, width, heroHeight);
                gradient.addColorStop(0, '#5eead4');
                gradient.addColorStop(1, this.backgroundColor);
                ctx.fillStyle = gradient;
                ctx.fillRect(0, 0, width, heroHeight);
            }

            // Blend the photo seamlessly into the solid colour field below it
            const fade = ctx.createLinearGradient(0, heroHeight * 0.55, 0, heroHeight);
            fade.addColorStop(0, 'rgba(0,0,0,0)');
            fade.addColorStop(1, this.backgroundColor);
            ctx.fillStyle = fade;
            ctx.fillRect(0, 0, width, heroHeight);
            ctx.restore();
        },

        drawContent(ctx, width, height, heroHeight) {
            const pad = width * 0.09;
            const contentWidth = width - pad * 2;
            let y = heroHeight + height * 0.045;

            ctx.textAlign = 'center';
            ctx.textBaseline = 'alphabetic';

            // Provider name — the hero focal point
            ctx.fillStyle = '#ffffff';
            ctx.font = `800 ${Math.round(width * 0.062)}px 'Nunito', sans-serif`;
            wrapText(ctx, provider.businessName || '', contentWidth).slice(0, 2).forEach((line, i) => {
                if (i > 0) y += width * 0.07;
                ctx.fillText(line, width / 2, y);
            });

            if (this.showCategory && provider.category) {
                y += width * 0.045;
                ctx.fillStyle = 'rgba(255,255,255,0.82)';
                ctx.font = `${Math.round(width * 0.028)}px 'Nunito', sans-serif`;
                ctx.fillText(provider.category, width / 2, y);
            }
            y += height * 0.04;

            // Badge row
            const badges = [];
            const location = [provider.suburb, provider.state].filter(Boolean).join(', ');
            if (this.showLocation && location) {
                badges.push({ icon: 'pin', text: location, bg: '#ffffff', color: '#0f766e' });
            }
            if (this.showTelehealth && provider.telehealth) {
                badges.push({ icon: 'monitor', text: 'Telehealth', bg: '#ffffff', color: '#0f766e' });
            }
            if (this.showWaitTime && provider.waitTime) {
                badges.push({ icon: 'clock', text: provider.waitTime, bg: '#ffffff', color: '#0f766e' });
            }
            if (badges.length) {
                y = drawBadgeRow(ctx, badges, width / 2, y, contentWidth, {
                    font: `600 ${Math.round(width * 0.024)}px 'Nunito', sans-serif`,
                    gap: width * 0.014,
                    padX: width * 0.018,
                    iconSize: width * 0.024,
                    height: width * 0.046,
                });
                ctx.textAlign = 'center';
                ctx.textBaseline = 'alphabetic';
            }
            y += height * 0.055;

            // Bio excerpt
            if (this.body) {
                ctx.fillStyle = 'rgba(255,255,255,0.92)';
                ctx.font = `${Math.round(width * 0.023)}px ${this.bodyFont}`;
                const bodyLineHeight = width * 0.034;
                wrapText(ctx, this.body, contentWidth * 0.9).slice(0, 3).forEach((line) => {
                    ctx.fillText(line, width / 2, y);
                    y += bodyLineHeight;
                });
                y += height * 0.025;
            }

            // Script heading + site watermark, anchored to the bottom
            ctx.fillStyle = this.headingColor;
            ctx.font = `${Math.round(width * 0.05)}px ${this.headingFont}`;
            ctx.fillText(this.heading, width / 2, height - height * 0.095);

            ctx.fillStyle = 'rgba(255,255,255,0.75)';
            ctx.font = `${Math.round(width * 0.02)}px 'Nunito', sans-serif`;
            ctx.fillText('kidshealthhub.com.au', width / 2, height - height * 0.045);
        },

        download() {
            this.draw();
            this.$refs.canvas.toBlob((blob) => {
                const url = URL.createObjectURL(blob);
                const a = document.createElement('a');
                a.href = url;
                a.download = `${provider.slug || 'provider'}-cover.png`;
                a.click();
                URL.revokeObjectURL(url);
            }, 'image/png');
        },
    };
}

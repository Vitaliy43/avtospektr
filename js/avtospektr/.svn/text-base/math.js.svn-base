/*

JMath v 0.1

Home page: http://loadj.ru/jmath/
Email: tria-aa@mail.ru
Write by Alexeev Artemiy 2011

*/

var JMath={
E:Math.E,
PI:Math.PI,
ln:function(x){return Math.log(x);},
log:function(x,y){return Math.log(y) / Math.log(x);},
sqrt:function(x,y){y = y || 2; return Math.pow(x, 1/y);},
abs:function(x){return Math.abs(x)},
pow:function(x,y){return Math.pow(x,y)},
acos:function(x){return Math.acos(x)},
asin:function(x){return Math.asin(x)},
exp:function(x){return Math.exp(x)},
sin:function(x){return Math.sin(x)},
tg:function(x){return Math.tan(x)},
ctg:function(x){return 1/Math.tan(x)},
cos:function(x){return Math.cos(x)},
atan:function(x){return Math.atan(x)},
max:function(x){var max = x[0]; for(var i=1;i<x.length;i++) if (x[i]>max) max = x[i]; return max;},
min:function(x){var min = x[0];for(var i=1;i<x.length;i++) if (x[i]<max) min = x[i]; return min;},
random:function(x,y){var x=x||0,y=y || 1; return Math.random()*(y - x) + x;},
round:function(x,y) {var y=y||0;y=Math.pow(10,y); var x = x * y; x = Math.round(x); x = x / y; return x;},
ceil:function(x,y) {var y=y||0;y=Math.pow(10,y); var x = x * y; x = Math.ceil(x); x = x / y; return x;},
floor:function(x,y) {var y=y||0;y=Math.pow(10,y); var x = x * y; x = Math.floor(x); x = x / y; return x;},
point:function(x,y){var obj={}; obj.x = x; obj.y = y; obj.name='point'; return obj;},
rotation:function(p,a,c){var o={name:'point'}; var c = c || {x:0,y:0}; o.x=(p.x-c.x)*Math.cos(a)-(p.y-c.y)*Math.sin(a);o.y=(p.x-c.x)*Math.sin(a)+(p.y-c.y)*Math.cos(a);return o;},
triangle:function(a,b,c,ab,bc,ca){
var o={name:'triangle'};
a=a||0;b=b||0;c=c||0;ab=ab||0;bc=bc||0;ca=ca||0;

//Углы
if (ab&&bc) ca = Math.PI-ab-bc;if (ab&&ca) bc = Math.PI-ab-ca;if (bc&&ca) ab = Math.PI-bc-ca;

//Теорема синусов, отношение углов
if (ab&&bc&&ca) {
  if (a&&!b) b = Math.sin(ca) / Math.sin(bc) * a;
  if (c&&!b) b = Math.sin(ca) / Math.sin(ab) * c;
  if (b&&!a) a = Math.sin(bc) / Math.sin(ca) * b;
  if (c&&!a) a = Math.sin(bc) / Math.sin(ab) * c;
  if (b&&!c) c = Math.sin(ab) / Math.sin(ca) * b;
  if (a&&!c) c = Math.sin(ab) / Math.sin(bc) * a;
}

//Теорема синусов, отношение сторон
var t = 0;
if (a&&bc) t = a/Math.sin(bc);
if (b&&ca) t = b/Math.sin(ca);
if (c&&ab) t = c/Math.sin(ab);    
  
if (t) {
  if (b&&!ca) ca = Math.asin(b/t);
  if (!b&&ca) b = Math.asin(t*Math.sin(ca));
  if (c&&!ab) ab = Math.asin(c/t);
  if (!c&&ab) c = Math.asin(t*Math.sin(ab));
  if (a&&!bc) bc = Math.asin(a/t);
  if (!a&&bc) a = Math.asin(t*Math.sin(bc));
}

//Теорема косинусов
//Стороны
if (a&&b&&ab&&!c)c=Math.sqrt(a*a+b*b-2*a*b*Math.cos(ab));
if (b&&c&&bc&&!a)a=Math.sqrt(b*b+c*c-2*b*c*Math.cos(bc));
if (a&&c&&ca&&!b){b=Math.sqrt(a*a+c*c-2*a*c*Math.cos(ca));}

//Углы
if (a&&b&&c) {
  if (!ab)ab=Math.acos( (a*a+b*b-c*c)/ (2*a*b) );
  if (!bc)bc=Math.acos( (b*b+c*c-a*a)/ (2*b*c) );
  if (!ca)ca=Math.acos( (c*c+a*a-b*b)/ (2*c*a) );
}

if (c) o.c=c; else return JMath.triangle(a,b,c,ab,bc,ca);
if (a) o.a=a;else return JMath.triangle(a,b,c,ab,bc,ca);
if (b) o.b=b;else return JMath.triangle(a,b,c,ab,bc,ca);
if (ab) o.ab=ab;else return JMath.triangle(a,b,c,ab,bc,ca);
if (ca) o.ca=ca;else return JMath.triangle(a,b,c,ab,bc,ca);
if (bc) o.bc=bc;else return JMath.triangle(a,b,c,ab,bc,ca);

//Медианы
o.mb = 0.5 * Math.sqrt(2*a*a+2*c*c - b*b);
o.ma = 0.5 * Math.sqrt(2*b*b+2*c*c - a*a);
o.mc = 0.5 * Math.sqrt(2*a*a+2*b*b - c*c);
//Периметр
o.p = a + b + c;
//Площадь
o.s = Math.sqrt(o.p/2*(o.p/2-a)*(o.p/2-b)*(o.p/2-c));
//Высоты
o.ha = 2*o.s/a;
o.hb = 2*o.s/b;
o.hc = 2*o.s/c;

return o;
},

toPi: function (x,e) {
  e = e || 2;
  for (i=1;i<20;i++)
  for (j=1;j<20;j++)
  if (JMath.round(x,e) == JMath.round(Math.PI*i/j,e)) {
      s = '';
      if (i != 1) s += i + ' ';
      s += 'pi';
      if (j!= 1) s += ' / ' + j;
      return s;
  }
  return x;
},
fac:function (x) {var x = x || 1, f = 1; for(var i=2;i<=x;i++) f = f*i; return f;},
x2:function(a,b,c){var x1=(-b+Math.sqrt(b*b-4*a*c))/2/a;var x2=(-b-Math.sqrt(b*b-4*a*c))/2/a;return {x1:x1,x2:x2}},
C:function(n,k){return JMath.fac(n)/JMath.fac(k)/JMath.fac(n-k)},
A:function(n,k){return JMath.fac(n)/JMath.fac(n-k)},

/* Умножение матриц */
matrixAB:function(A,B){var C = [];for (var i = 0; i < A.length; i++)for (var j = 0; j < B[0].length; j++) {if (!C[i]) C[i]=[];C[i][j]=0;for (var k=0;k<A[0].length;k++)C[i][j] += A[i][k]*B[k][j];}return C;},

/* Сложение матриц */
matrixPlus:function(A,B) {var C = [];for (var i =0;i<A.length;i++)for (var j =0;j<A[0].length;j++) {if (!C[i])C[i] = [];C[i][j] = A[i][j] + B[i][j];}return C;},

/* Вычитание матриц */
matrixMinus:function(A,B) {return JMath.matrixPlus(A, JMath.matrixAb(B,-1));},

/* Транспонирует матрицу */
matrixT:function(A) {var C = [];for (var i =0;i<A.length;i++)for (var j =0;j<A[0].length;j++) {if (!C[j])C[j] = [];C[j][i] = A[i][j];}return C;},

/* Приводит матрицу (двумерный массив) к строке */
printMatrix:function(A) {var S = '[';for (var i =0;i<A.length;i++) {S += '[';S += A[i].join(',');S += ']';}S += ']';return S;},

/* Вычисляет определитель матрицы A */
det:function(A) {S = 0;if (A[0].length == 2) return A[0][0]*A[1][1] - A[0][1]*A[1][0];for (var j=0;j<A[0].length;j++) {C = JMath.minor(A,0,j);S+=A[0][j]*Math.pow(-1,j)*JMath.det(C);}return S;},

/* Возвращает минор матрицы A по элементы x,y */
minor:function(A,x,y) {var C = [];  for (var i=0;i<A.length;i++)  for (var j=0;j<A[i].length;j++) {if (i<x) {if (!C[i]) C[i] = []; if (j>y) C[i][j-1] = A[i][j]; if (j<y) C[i][j] = A[i][j];}if (i>x) {if (!C[i-1]) C[i-1] = []; if (j>y) C[i-1][j-1] = A[i][j]; if (j<y) C[i-1][j] = A[i][j];}}return C;},

/* Вычисление обратной матрицы */
reverse:function(A) {var C = []; for (var i=0;i<A.length;i++) for (var j=0;j<A[i].length;j++) { if (!C[i]) C[i] = [];C[i][j] = Math.pow(-1,i+j)*JMath.det(JMath.minor(A,i,j));}C = JMath.matrixT(C);return JMath.matrixAb(C, 1/JMath.det(A));},

/* Умножение числа на матрицу */
matrixAb:function(A,b) {var C = []; for (var i=0;i<A.length;i++) for (var j=0;j<A[i].length;j++) { if (!C[i]) C[i] = []; C[i][j] = A[i][j]*b;} return C;},

/* Остаток от деления */
mod:function(x,y) {return x%y;},

/* Гиперболический косинус */
ch:function(x) {return (JMath.exp(x) + JMath.exp(-x))/2},

/* Гиперболический синус */
sh:function(x) {return (JMath.exp(x) - JMath.exp(-x))/2},

/* Гиперболический тангенс */
th:function(x) {return JMath.sh(x) / JMath.ch(x)},

/* Гиперболический катангенс */
cth:function(x) {return JMath.ch(x) / JMath.sh(x)},

/* Функция рисования */
draw:function(f,options) {

var s = options.step || 2;
var m = options.zoom || 100;
var a = options.x[0] || -1;
var b = options.x[1] || 1;
var c = options.y[0] || -1;
var d = options.y[1] || 1;

var area = document.createElement('div');
area.style.background = '#FFF';
area.style.width = (b-a)*m + 'px';
area.style.height = (d-c)*m + 'px';
for (var i=a, sh = JMath.round(s/m,4); i < b; i+=sh)
{
  var p = document.createElement('div');
  p.style.position = 'absolute';
  p.style.left = JMath.round((i - a)*m) + 'px';
  p.style.top = ((d-c)*m - JMath.round(f(i - a)*m)) + 'px';
  p.style.backgroundColor = options.color;
  p.style.width = s + 'px';
  p.style.height = s + 'px';
  area.appendChild(p);
}
var d = document.createElement('div')
d.appendChild(area);
document.writeln('<html><body>' + d.innerHTML + '</body></html>');
}

};



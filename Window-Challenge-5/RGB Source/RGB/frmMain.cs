namespace RGB
{
    using System;
    using System.ComponentModel;
    using System.Drawing;
    using System.Text;
    using System.Windows.Forms;

    public class frmMain : Form
    {
        private byte[] a = new byte[] { 
            20, 0x16, 100, 0x17, 0x15, 0x63, 100, 0x67, 0x18, 0x18, 0x19, 0x60, 0x19, 0x67, 0x10, 0x15, 
            0x10, 0x18, 0x16, 0x11, 0x62, 0x67, 0x67, 0x10, 0x17, 0x12, 0x67, 0x18, 0x11, 0x63, 0x60, 0x12
         };
        private byte[] b = new byte[] { 
            0x61, 0x5d, 0x40, 0x40, 0x4b, 0x13, 0x12, 0x6b, 0x5d, 0x47, 0x12, 0x54, 0x53, 0x5b, 0x5e, 0x57, 
            0x56, 0x12, 0x4a, 0x62, 0x12, 0x12, 0x66, 0x40, 0x4b, 0x12, 0x73, 0x55, 0x53, 0x5b, 0x5c, 0x13
         };
        private Button btnCheck;
        private int c = 0x89;
        private IContainer components;
        private int d = 50;
        private byte[] g = new byte[] { 
            0x71, 0x60, 0x6f, 90, 0x4d, 0x15, 0x43, 0x58, 0x53, 0x10, 0x4f, 0x16, 0x49, 0x7e, 0x52, 0x15, 
            0x58, 0x5b, 0x7e, 0x59, 0x11, 0x53, 0x10, 0x52, 0x7e, 0x15, 0x4c, 0x15, 0x5b, 0x10, 0x4f, 70, 
            0x5c
         };
        private GroupBox groupBox1;
        private Label lblB;
        private Label lblG;
        private Label lblR;
        private HScrollBar sbB;
        private HScrollBar sbG;
        private HScrollBar sbR;

        public frmMain()
        {
            this.InitializeComponent();
        }

        private void btnCheck_Click(object sender, EventArgs e)
        {
            int num = this.sbR.Value;
            int num2 = this.sbG.Value;
            int num3 = this.sbB.Value;
            int num4 = num2 * num3;
            int num5 = num * 3;
            if ((((((num + num4) - num2) + ((num * num) * num2)) - num3) == ((num2 * ((num3 * 0x22) + (num5 - num))) + 0xea0)) && (num > 60))
            {
                MessageBox.Show(this.szB(num, num2, num3, (byte[]) this.g.Clone(), num4, num5));
            }
            else
            {
                MessageBox.Show(this.szA(num, num2, num3, (byte[]) this.a.Clone(), num4, num5));
            }
        }

        protected override void Dispose(bool disposing)
        {
            if (disposing && (this.components != null))
            {
                this.components.Dispose();
            }
            base.Dispose(disposing);
        }

        private void InitializeComponent()
        {
            this.groupBox1 = new GroupBox();
            this.lblB = new Label();
            this.lblG = new Label();
            this.lblR = new Label();
            this.sbB = new HScrollBar();
            this.sbG = new HScrollBar();
            this.sbR = new HScrollBar();
            this.btnCheck = new Button();
            this.groupBox1.SuspendLayout();
            base.SuspendLayout();
            this.groupBox1.Controls.Add(this.lblB);
            this.groupBox1.Controls.Add(this.lblG);
            this.groupBox1.Controls.Add(this.lblR);
            this.groupBox1.Controls.Add(this.sbB);
            this.groupBox1.Controls.Add(this.sbG);
            this.groupBox1.Controls.Add(this.sbR);
            this.groupBox1.Location = new Point(15, 0x13);
            this.groupBox1.Name = "groupBox1";
            this.groupBox1.Size = new Size(0x22b, 0xb1);
            this.groupBox1.TabIndex = 0;
            this.groupBox1.TabStop = false;
            this.groupBox1.Text = "Controllers";
            this.lblB.AutoSize = true;
            this.lblB.Location = new Point(0x202, 0x86);
            this.lblB.Name = "lblB";
            this.lblB.Size = new Size(13, 13);
            this.lblB.TabIndex = 5;
            this.lblB.Text = "0";
            this.lblG.AutoSize = true;
            this.lblG.Location = new Point(0x202, 0x5d);
            this.lblG.Name = "lblG";
            this.lblG.Size = new Size(13, 13);
            this.lblG.TabIndex = 4;
            this.lblG.Text = "0";
            this.lblR.AutoSize = true;
            this.lblR.Location = new Point(0x202, 50);
            this.lblR.Name = "lblR";
            this.lblR.Size = new Size(13, 13);
            this.lblR.TabIndex = 3;
            this.lblR.Text = "0";
            this.sbB.Location = new Point(7, 130);
            this.sbB.Maximum = 0x108;
            this.sbB.Name = "sbB";
            this.sbB.Size = new Size(0x1e7, 0x11);
            this.sbB.TabIndex = 2;
            this.sbB.Scroll += new ScrollEventHandler(this.sbB_Scroll);
            this.sbG.Location = new Point(5, 0x59);
            this.sbG.Maximum = 0x108;
            this.sbG.Name = "sbG";
            this.sbG.Size = new Size(0x1e9, 0x11);
            this.sbG.TabIndex = 1;
            this.sbG.Scroll += new ScrollEventHandler(this.sbG_Scroll);
            this.sbR.Location = new Point(7, 50);
            this.sbR.Maximum = 0x108;
            this.sbR.Name = "sbR";
            this.sbR.Size = new Size(0x1e7, 0x11);
            this.sbR.TabIndex = 0;
            this.sbR.Scroll += new ScrollEventHandler(this.sbR_Scroll);
            this.btnCheck.Location = new Point(0x1ef, 0xd6);
            this.btnCheck.Name = "btnCheck";
            this.btnCheck.Size = new Size(0x4b, 0x17);
            this.btnCheck.TabIndex = 1;
            this.btnCheck.Text = "Check";
            this.btnCheck.UseVisualStyleBackColor = true;
            this.btnCheck.Click += new EventHandler(this.btnCheck_Click);
            base.AutoScaleDimensions = new SizeF(6f, 13f);
            base.AutoScaleMode = AutoScaleMode.Font;
            base.ClientSize = new Size(0x247, 0xf7);
            base.Controls.Add(this.btnCheck);
            base.Controls.Add(this.groupBox1);
            base.Name = "frmMain";
            base.StartPosition = FormStartPosition.CenterScreen;
            this.Text = "RGB by -.-\"";
            this.groupBox1.ResumeLayout(false);
            this.groupBox1.PerformLayout();
            base.ResumeLayout(false);
        }

        private void sbB_Scroll(object sender, ScrollEventArgs e)
        {
            this.lblB.Text = this.sbB.Value.ToString();
        }

        private void sbG_Scroll(object sender, ScrollEventArgs e)
        {
            this.lblG.Text = this.sbG.Value.ToString();
        }

        private void sbR_Scroll(object sender, ScrollEventArgs e)
        {
            this.lblR.Text = this.sbR.Value.ToString();
        }

        private string szA(int iDummy1, int iDummy2, int iDummy3, byte[] bArrayA, int iDummy4, int iDummy5)
        {
            for (int i = 0; i < bArrayA.Length; i++)
            {
                bArrayA[i] = (byte) (this.b[i] ^ this.d);
            }
            return Encoding.ASCII.GetString(bArrayA);
        }

        private string szB(int iDummy1, int iDummy2, int iDummy3, byte[] bArrayA, int iDummy4, int iDummy5)
        {
            for (int i = 0; i < bArrayA.Length; i++)
            {
                int index = i;
                bArrayA[index] = (byte) (bArrayA[index] ^ ((byte) (this.c ^ iDummy2)));
            }
            return Encoding.ASCII.GetString(bArrayA);
        }
    }
}

